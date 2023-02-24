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

    public function mappingNames(Request $request)
    {
        dd($request->all());
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
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {            
            // dd($getData);
            // Validation
            if($getData[4] == '' ||
                $getData[6] == '' ||
                $getData[15] == '')
            {
                // If empty/NULL ignore row, skip to next one
                $fails++;
                continue;
            }

            $item[($request->get('mapCol_1')) ? $request->get('mapCol_1') : 'number'] = $getData[0];
            $item[($request->get('mapCol_2')) ? $request->get('mapCol_2') : 'gender'] = $getData[1];
            $item[($request->get('mapCol_3')) ? $request->get('mapCol_3') : 'name_set'] = $getData[2];
            $item[($request->get('mapCol_4')) ? $request->get('mapCol_4') : 'title'] = $getData[3];                
            $item[($request->get('mapCol_5')) ? $request->get('mapCol_5') : 'given_name'] = $getData[4]; // Obligatory
            $item[($request->get('mapCol_6')) ? $request->get('mapCol_6') : 'middle_initial'] = $getData[5];
            $item[($request->get('mapCol_7')) ? $request->get('mapCol_7') : 'surname'] = $getData[6]; // obligatory
            $item[($request->get('mapCol_8')) ? $request->get('mapCol_8') : 'street_address'] = $getData[7];
            $item[($request->get('mapCol_9')) ? $request->get('mapCol_9') : 'city'] = $getData[8];
            $item[($request->get('mapCol_10')) ? $request->get('mapCol_10') : 'state'] = $getData[9];
            $item[($request->get('mapCol_11')) ? $request->get('mapCol_11') : 'zip_code'] = $getData[11];
            $item[($request->get('mapCol_12')) ? $request->get('mapCol_12') : 'country'] = $getData[12];
            $item[($request->get('mapCol_13')) ? $request->get('mapCol_13') : 'email_address'] = $getData[14];
            $item[($request->get('mapCol_14')) ? $request->get('mapCol_14') : 'username'] = $getData[15]; // obligatory
            $item[($request->get('mapCol_15')) ? $request->get('mapCol_15') : 'password'] = $getData[16];
            $item[($request->get('mapCol_16')) ? $request->get('mapCol_16') : 'browser_user_agent'] = $getData[17];
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

        fclose($file);  

        return redirect('importCSV')->with(['reportData' => $report]);
     }

}
