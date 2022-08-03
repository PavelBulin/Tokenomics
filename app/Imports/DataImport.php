<?php

namespace App\Imports;

use App\Models\Data;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $data = new Data([
        //   'name' => $row['name'],
        //   'globalPercent' => $row['allocation'],
        //   'adress' => $row['adress'],
        //   'raund' => (string) $row['raund'],
        //   'unblocked' => $row['unblocked'] - 1,
        // ]);

        // $data = $data->toArray();

        // $days = [];
        // for ($i=1; $i <= 49; $i++) {
        //   $days[] = $i . 'Mo';
        // }

        // $bDate = getBaseDate();

        // $bDate = DB::table('base_date')->first()->time;
        // $cDate = mktime(3, 0, 0, date('m'), 1, date('Y'));
        // $dif = (int) round((($cDate - $bDate) / (60 * 60 * 24 * 10)) / 3);

        // $globalPercent = $data['globalPercent'] / 100;

        // unset($data['globalPercent']);
        // $data['blocked'] = $dif;
        // // DB::table('categories')->insert($data);

        // $tokenomics = [];
        // $tokenomics['category_id'] = Category::all()->last()->id;
        // $tokenomics['globalPercent'] = $globalPercent;
        // $period = $data['unblocked'] - $dif;

        // if ($period == 0) {
        //   $perсent = 1;
        //   $count = 1;
        // } else if ($period > 0){
        //   $perсent = (100 / $period) / 100;
        //   $count = $period;
        // } else {
        //   $perсent = 0;
        //   $count = 0;
        // }

        // foreach ($days as $key => $day) {
        //   if ($count > 0) {
        //     $tokenomics[$day] = (float) $perсent;
        //   }
        //   $count--;
        // }

      // DB::table('tokenomics')->insert($tokenomics);

        return new Data([
          'address' => $row['address'],
          'raund' => $row['raund'],
          'blocked' => $row['blocked'],
          'unlocked' => $row['unlocked'],
          'timeToUnlock' => $row['timetounlock'],
          'timeToFullUnlock' => $row['timetofullunlock'],
        ]);

    }
}
