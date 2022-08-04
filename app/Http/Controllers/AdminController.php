<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DateTime;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Category;
use App\Models\Tokenomic;

class AdminController extends Controller
{
    public function index(Request $request)
    {

      $search = $request->input('search');

      $thead = ["Address", "Round", "Blocked", "Unlocked", "Time to unlock", "Time to full unlock"];
      $cArrs = Category::get()->toArray();
      $dArr = Data::all()->toArray();
            $dArr = array_filter($dArr, function ($dt) use ($search) {

        if ($search && ! str_contains(strtolower($dt['address']), strtolower($search))) {
        return false;
      }

      return true;
      });

     $catNames = [];
     foreach ($cArrs as $key => $arr) {
        $catNames[] = $arr['name'];
      }

      $blocked = [];
      $data = [];
      foreach ($dArr as $key => $dt) {
        $blocked[] = $dt['blocked'];
        foreach ($dt as $k => $elem) {
        if (!str_ends_with($k, "ated_at") && !($k == 'id')) {
                    $data[$key][$k] = $elem;
        }
      }
      }

      $sum = array_sum($blocked);
      $tArrs = Tokenomic::get()->toArray();
      foreach ($tArrs as $index => $arr) {
        foreach ($arr as $key => $elm) {
          if (preg_match('#^\d+Mo$#', $key)) {
            $tokenomics[$index][$key] = $elm;
          }
        }
      }
      $size = count($tArrs);
      $percents = [];

      foreach ($tArrs as $key => $arr) {
        $percents[] = $arr['globalPercent'] * 100;
      }

      return view('index', [
        'size' => $size,
        'tokenomics' => $tokenomics,
        'percents' => $percents,
        'catNames' => $catNames,
        'thead' => $thead,
        'data' => $data,
        'sum' => $sum,
        'bSum' => DB::table('base_sum')->first()->sum,
      ]);
    }

    public function сategoryForm ()
    {
      if (!DB::table('base_date')->first()) {
        DB::table('base_date')->insert(['time' => mktime(3, 0, 0, date('m'), 1, date('Y'))]);
      }
      $bDate = DB::table('base_date')->first()->time;

      $tokenomics = Tokenomic::all();

      $pers = 0;
      foreach ($tokenomics as $tokenomic) {
        $pers += $tokenomic->globalPercent;
      }
      $gPercent = (int) (100 - $pers * 100);

      for ($i = 1; $i <= $gPercent; $i++) {
        $gPercents[] = $i;
      }

      return view('addForm', [
        'gPercents' => $gPercents,
        'baseDate' => $bDate,
        'bSum' => DB::table('base_sum')->first()->sum,
      ]);
    }

    public function createTokenomic(Request $request)
    {

      $globalPercent = $request->input('globalPercent');
      $name = $request->input('name');
      $adress = $request->input('adress');
      $raund = $request->input('raund');
      $unblocked = $request->input('unblocked');
      $firstPersent = $request->input('firstPersent');
      $restPersent = $request->input('restPersent');
      $bSum = $request->input('baseSum');

    $days = [];
    for ($i=1; $i <= 49; $i++) {
      $days[] = $i . 'Mo';
    }

      $bDate = DB::table('base_date')->first()->time;
            $cDate = mktime(3, 0, 0, date('m'), 1, date('Y'));
            $dif = (int) round((($cDate - $bDate) / (60 * 60 * 24 * 10)) / 3);
            $period = $unblocked - $dif;
      $pers = [];
      $count = 0;
      foreach ($days as $key => $day) {
        if ($key == $dif) {
          $pers[$day] = (float) $firstPersent;
          $count = $period;
        } else if ($count > 0) {
          $pers[$day] = (float) $restPersent;
          $count--;
        } else {
          $pers[$day] = 0;
        }
      }

      Category::create([
      'name' => $name,
      'adress' => $adress,
      'raund' => $raund,
      'blocked' => $dif,
      'unblocked' => $unblocked,
      ]);

      $category_id = Category::all()->last()->id ?? 0;

      $tokenomic = [
        'globalPercent' => $globalPercent / 100,
        'category_id' => $category_id,
      ];


      foreach ($pers as $key => $per) {
        $tokenomic[$key] = $per;
      }
      Tokenomic::create($tokenomic);
      DB::table('base_sum')->where('id', 1)->update(['sum' => $bSum]);


      return redirect()->route('msg');
    }

    public function showTokenomic()
    {
      $arrs = Tokenomic::get()->toArray();
            $tokenomics = [];
      foreach ($arrs as $key => $arr) {
                $catName = DB::table('categories')->where('id', $arr['category_id'])->first()->name;
        $tokenomics[$key]['category_id'] = $arr['category_id'];
        $tokenomics[$key]['name'] = $catName;
        $tokenomics[$key]['globalPercent'] = $arr['globalPercent'] * 100;
        for ($i=1; $i <= 49; $i++) {
          $tokenomics[$key][$i . 'Mo'] = sprintf('%.01F',$arr[$i . 'Mo'] * 100);
        }
      }

      $thead = ["", "Категория", "Доля"];
      for ($i=1; $i <= 49; $i++) {
        $thead[] = $i . 'Mo';
      }
      return view('show', [
        'thead' => $thead,
        'tokenomics' => $tokenomics,
      ]);
    }

    public function changeTokenomic(Request $request)
    {
      $all = $request->all();
            foreach ($all as $key => $val) {
        if ($key != '_token') {
          $field =  explode('-', $key)[0];
                  if ($field != "_name" && $field != "_unblocked") {
            Tokenomic::where('category_id', explode('-', $key)[1])->update([
              str_replace('_', '', explode('-', $key)[0]) => $val,
            ]);
          } else {
            Category::where('id', explode('-', $key)[1])->update([
              str_replace('_', '', explode('-', $key)[0]) => $val,
            ]);
          }
        }
      }
      return redirect()->route('user.admin');
    }

    public function deleteTokenomic($id = null)
    {
      Category::where('id', $id)->delete();
      Tokenomic::where('category_id', $id)->delete();
      return redirect()->route('user.show');
    }

    public function showAddress ($address)
    {

      $dArr = Data::where('address', $address)->first()->toArray();
      $data = [];

        foreach ($dArr as $k => $elem) {
        if (!str_ends_with($k, "ated_at") && !($k == 'id')) {
                    $data[$k] = $elem;
        }
      }

      return view('adres', [
        'data' => $data,
      ]);
    }
}