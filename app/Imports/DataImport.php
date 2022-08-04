<?php

namespace App\Imports;

use App\Models\Data;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

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
