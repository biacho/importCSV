<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Exports\UsersExport;
 
use App\Imports\CSVImport;
use App\Models\ImportedData;
use Maatwebsite\Excel\Facades\Excel;
 
use App\Models\User;

class ImportController extends Controller
{
    //
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
       return view('index');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcelCSV(Request $request) 
    {
        $validatedData = $request->validate([
 
           'file' => 'required',
 
        ]);
 
        Excel::import(new CSVImport(),$request->file('file'));
 
            
        return redirect('/')->with('status', 'The file has been excel/csv imported to database in Laravel 10');
    }
}
