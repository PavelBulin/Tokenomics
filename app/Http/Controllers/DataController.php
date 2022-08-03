<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Imports\DataImport;

class DataController extends Controller
{
    public function inportdata()
    {
      return view('import');
    }

    public function uploadData(Request $request)
    {

      // dd($request->all());
      Excel::import(new DataImport, $request->file);

      return redirect()->route('user.admin');
      return redirect()->route('user.admin')->with('success', 'Данные загружены успешно');
    }
}
