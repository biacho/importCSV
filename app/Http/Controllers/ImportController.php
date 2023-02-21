<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Imports\CSVImport;
use App\Models\ImportedData;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidation;
 
use App\Models\User;
use Dotenv\Exception\ValidationException as ExceptionValidationException;

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
        
        // dd($request->file('file'));


        // $collection = Excel::toArray(new CSVImport, $request->file('file'));
        // dd($collection[0]);
        // dd(count($collection[0]));

        $start_time = microtime(true);
        $import = new CSVImport();
        $import->import($request->file('file'));
        $end_time = microtime(true);
        
        // Calculate script execution time
        $execution_time = ($end_time - $start_time);
        dd(round($execution_time, 1) + 'secounds.');
        
        // foreach ($import->failures() as $failure) {
        //     $failure->row(); // row that went wrong
        //     $failure->attribute(); // either heading key (if using heading row concern) or column index
        //     $failure->errors(); // Actual error messages from Laravel validator
        //     $failure->values(); // The values of the row that has failed.
        // }
        

        return redirect('/')->with('status', 'Import Done.');
    }
}
