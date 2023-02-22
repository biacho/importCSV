<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\CSVImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidation;
// use Dotenv\Exception\ValidationException as ExceptionValidationException;


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
        
        //
        // Prawidlowa implementacja importu danych z pliku CSV !! <facepalm>
        //
        // $file = fopen($request->file('file'), "r");
        // $data = [];
        // while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        // {
        //     array_push($data, $getData[1]);
        // }
        // dd($data);
 
        $reportData = [];


        $tempData = Excel::toArray(new CSVImport, $request->file('file'));
        $rowsToImport = count($tempData[0]);
        $reportData['rowsToImport'] = $rowsToImport;
        $tempData = [];

        $start_time = microtime(true);
        $import = new CSVImport();
        $import->import($request->file('file'));
        $end_time = microtime(true);
        

        $execution_time = ($end_time - $start_time);
        $reportData['importTime'] = round($execution_time, 1);
        
        foreach ($import->failures() as $failure) {
            $failure->row(); // row that went wrong
            $failure->attribute(); // either heading key (if using heading row concern) or column index
            $failure->errors(); // Actual error messages from Laravel validator
            $failure->values(); // The values of the row that has failed.
        }
        $failures = count($import->failures());


        $reportData['importFailure'] = $failures;
        $reportData['importSuccess'] = $rowsToImport - $failures;

        return redirect('/')->with(['reportData' => $reportData]);
    }
}
