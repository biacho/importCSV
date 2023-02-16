<?php

namespace App\Imports;

use App\Models\ImportedData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CSVImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportedData([
            'number' => $row['number'],
            'gender' => $row['gender'],
            'name_set' => $row['name_set'],
            'title' => $row['title'],
            'given_name' => $row['given_name'],
            'middle_initial' => $row['middle_initial'],
            'surname' => $row['surname'],
            'street_address' => $row['street_address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip_code' => $row['zip_code'],
            'country' => $row['country'],
            'email_address' => $row['email_address'],
            'password' => $row['password'],
            'username' => $row['username'],
            'browser_user_agent' => $row['browser_user_agent']
        ]);
    }
}
