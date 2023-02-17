<?php

namespace App\Imports;

use App\Models\ImportedData;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CSVImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportedData([
            'number' => $row['Number'],
            'gender' => $row['Gender'],
            'name_set' => $row['NameSet'],
            'title' => $row['Title'],
            'given_name' => $row['GivenName'],
            'middle_initial' => $row['MiddleInitial'],
            'surname' => $row['Surname'],
            'street_address' => $row['StreetAddress'],
            'city' => $row['City'],
            'state' => $row['State,'],
            'zip_code' => $row['ZipCode'],
            'country' => $row['Country'],
            'email_address' => $row['EmailAddress'],
            'password' => $row['Username'],
            'username' => $row['Password'],
            'browser_user_agent' => $row['BrowserUserAgentt']
        ]);
    }

    public function rules(): array
    {
        return [
            'username' => Rule::requiredIf(true),
        ];
    }
    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'username.require' => 'Cell :attribute is empty.',
        ];
    }
}
