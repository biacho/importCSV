<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportCSVController extends Controller
{
    public function show()
    {
        $headers = [];
        $headers = DB::table('headers')->get();

        return view('index', ['headers' => $headers]);
    }

    public function importCSV(Request $request)
    {
        $validatedData = $request->validate([
 
            'file' => 'required',
  
         ]);

        $file = fopen($request->file('file'), "r");

        // First Step of validation
        $colNames = fgetcsv($file, 0, ";");
        if(count($colNames) > 50) return redirect('importCSV')->with('error', 'File have too many colums (max 50).'); 

        $start_time = microtime(true);
        $rows = [];
        $success = 0;
        $fails = 0;
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
        {            
            // Validation
            if($getData[4] == '' ||
                $getData[6] == '' ||
                $getData[15] == '')
            {
                // If empty/NULL ignore row, skip to next one
                $fails++;
                continue;
            }

            $item['number'] = $getData[0];
            $item['gender'] = $getData[1];
            $item['name_set'] = $getData[2];
            $item['title'] = $getData[3];                
            $item['given_name'] = $getData[4]; // Obligatory
            $item['middle_initial'] = $getData[5];
            $item['surname'] = $getData[6]; // obligatory
            $item['street_address'] = $getData[7];
            $item['city'] = $getData[8];
            $item['state'] = $getData[9];
            $item['zip_code'] = $getData[11];
            $item['country'] = $getData[12];
            $item['email_address'] = $getData[14];
            $item['username'] = $getData[15]; // obligatory
            $item['password'] = $getData[16];
            $item['browser_user_agent'] = $getData[17];
            array_push($rows, $item);
            $success++;
        }
        DB::table('imported_data')->insert($rows);

        $end_time = microtime(true);
        $executionTime = round($end_time - $start_time, 2);
        
        $report['execTime'] = $executionTime;
        $report['toImport'] = $success + $fails;
        $report['success'] = $success;
        $report['fails'] = $fails;

        dd($report);

        fclose($file);  

        return redirect('show');
     }

}
