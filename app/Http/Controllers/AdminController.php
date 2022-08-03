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
  // public function home(Request $request)
  //   {

  //     $search = $request->input('search');

  //     $cArrs = Category::get()->toArray();
  //     $tArrs = Tokenomic::get()->toArray();
  //     // dd($tArrs);
  //     // $globalPercent = $tArrs['globalPercent'] * 100;
  //     $thead = ["Address", "Round", "Allocation", "Blocked", "Unlocked", "Time to unlock"];
  //     $categories = [];
  //     $catNames = [];
  //     $tokenomics = [];

  //     $bDate = getBaseDate();
  //     $cDate = mktime(3, 0, 0, date('m'), 1, date('Y'));
  //     $monthQty = round(($cDate - $bDate) / (60 * 60 * 24 * 10)) / 3;
  //     $locks = 0;// dd($monthQty);
  //     $timesToUnlock = [];
  //     foreach ($cArrs as $key => $arr) {
  //       $gPerc = DB::table('tokenomics')
  //         ->where('category_id', $arr['id'])
  //         ->first()->globalPercent;
  //         // dump($gPerc);

  //       $catNames[] = $arr['name'];
  //       $categories[$key]['adress'] = $arr['adress'];
  //       $categories[$key]['raund'] = $arr['raund'];
  //       $categories[$key]['globalPercent'] = $gPerc * 100;
  //       $categories[$key]['blocked'] = $arr['blocked'] + 1;
  //       $categories[$key]['unblocked'] = $arr['unblocked'] + 1;
  //       $categories[$key]['timeToUnlock'] = $arr['unblocked'] - $monthQty;
  //       $timesToUnlock[] = $arr['unblocked'] - $monthQty;
  //       if ($arr['unblocked'] - $monthQty > 0) {
  //         $locks++;
  //       }
  //     }

  //     // dd($categories);
  //     // dd($categories[0]['adress']);

  //     // foreach ($categories as $key => $cat) {
  //       $gQtyOfCats = count($categories);
  //       $categories = array_filter($categories, function ($category) use ($search) {
  //           // dd($category);
  //         if ($search && ! str_contains(strtolower($category['adress']), strtolower($search))) {
  //           return false;
  //         }

  //       return true;
  //       });
  //     // }

  //     foreach ($tArrs as $index => $arr) {
  //       foreach ($arr as $key => $elm) {
  //         if (preg_match('#^\d+Mo$#', $key)) {
  //           $tokenomics[$index][$key] = $elm;
  //         }
  //       }
  //     }
  //     // dd(max($timesToUnlock));
  //     $size = count($categories);
  //     // dd($tokenomics);
  //     // dd(DB::table('base_sum')->first()->sum);
  //     return view('home', [
  //       'thead' => $thead,
  //       'categories' => $categories,
  //       'tokenomics' => $tokenomics,
  //       'catNames' => $catNames,
  //       'size' => $size,
  //       'gQtyOfCats' => $gQtyOfCats,
  //       'locks' => $locks,
  //       'maxTime' => max($timesToUnlock),
  //       'bSum' => DB::table('base_sum')->first()->sum,
  //     ]);
  //   }

    public function index(Request $request)
    {

      $search = $request->input('search');

      $thead = ["Address", "Round", "Blocked", "Unlocked", "Time to unlock", "Time to full unlock"];
      $cArrs = Category::get()->toArray();
      $dArr = Data::all()->toArray();
      // dd($dArr);
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
          // dump($k);
          $data[$key][$k] = $elem;
        }
      }
      }


      // dd($blocked);
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
      // dump($bDate);
      $cDate = mktime(3, 0, 0, date('m'), 1, date('Y'));
      // dump($cDate);
      $dif = (int) round((($cDate - $bDate) / (60 * 60 * 24 * 10)) / 3);
      // dd($dif);
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
// dd($pers);

      // dd($category_id);
      // $validated = validate($request->all(), [
      //   'title' => ['required', 'string', 'max:100'],
      //   'content' => ['required', 'string', 'max:10000'],
      // ]);

      // $title = $validated['title'];
      // $content = $validated['content'];

      Category::create([
      'name' => $name,
      'adress' => $adress,
      'raund' => $raund,
      'blocked' => $dif,
      'unblocked' => $unblocked,
      ]);

      $category_id = Category::all()->last()->id ?? 0;
      // dd($category_id);

      $tokenomic = [
        'globalPercent' => $globalPercent / 100,
        'category_id' => $category_id,
      ];


      foreach ($pers as $key => $per) {
        $tokenomic[$key] = $per;
      }
      // dd($tokenomic);
      Tokenomic::create($tokenomic);


      DB::table('base_sum')->where('id', 1)->update(['sum' => $bSum]);

      // alert(__('Сохранено!'));

      return redirect()->route('msg');


    }

    public function showTokenomic()
    {
      $arrs = Tokenomic::get()->toArray();
      // dd($arrs);
      $tokenomics = [];
      foreach ($arrs as $key => $arr) {
        // dd($arrs);
        $catName = DB::table('categories')->where('id', $arr['category_id'])->first()->name;
        $tokenomics[$key]['category_id'] = $arr['category_id'];
        $tokenomics[$key]['name'] = $catName;
        $tokenomics[$key]['globalPercent'] = $arr['globalPercent'] * 100;
        for ($i=1; $i <= 49; $i++) {
          $tokenomics[$key][$i . 'Mo'] = sprintf('%.01F',$arr[$i . 'Mo'] * 100);
        }
      }
      // dd($tokenomics);

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
      // dd($all);
      foreach ($all as $key => $val) {
        if ($key != '_token') {
          $field =  explode('-', $key)[0];
        // dd(explode('-', $key)[1]);
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

    public function showCategory ($address)
    {
      // $arr = Category::where('adress', $address)->first()->toArray();
      // // dd($arr);
      // $gPerc = tokenomic::where('category_id', $arr['id'])->first();

      // $category = [];
      // $category['allocation'] = $gPerc->globalPercent * 100;
      // foreach ($arr as $key => $val) {
      //   // dump($key);
      //   if (!str_ends_with($key, "ated_at")) {
      //     $category[$key] = $val;
      //   }
      // }
      // $category['offTime'] = $category['unblocked'] - $category['blocked'];
      // unset($category['id']);
      // // dd($category);
      // // dd($category->toArray());

      // return view('adres', [
      //   'category' => $category,
      // ]);
    }

    public function showAddress ($address)
    {

      $dArr = Data::where('address', $address)->first()->toArray();
      $data = [];

        foreach ($dArr as $k => $elem) {
        if (!str_ends_with($k, "ated_at") && !($k == 'id')) {
          // dump($k);
          $data[$k] = $elem;
        }
      }



      // dd($category);
      // dd($category->toArray());

      return view('adres', [
        // 'percents' => $percents,

        'data' => $data,
        // 'sum' => $sum,
        // 'bSum' => DB::table('base_sum')->first()->sum,
      ]);
    }
}



// Transposition
// foreach ($arrs->toArray() as $key => $arr) {
//   $catName = Category::where('id', $arrs->find($key + 1)->category_id)->value('name');
//   $tokenomics['name'][] = $catName;
//   $tokenomics['gPercent'][] = $arr['globalPercent'];
//   $tokenomics['Mo'][] = $arr['Mo'];
//   $tokenomics['Tu'][] = $arr['Tu'];
//   $tokenomics['We'][] = $arr['We'];
//   $tokenomics['Th'][] = $arr['Th'];
//   $tokenomics['Fr'][] = $arr['Fr'];
//   $tokenomics['Sa'][] = $arr['Sa'];
//   $tokenomics['Su'][] = $arr['Su'];
// }