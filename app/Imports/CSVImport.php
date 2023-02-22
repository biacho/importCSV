<?php

namespace App\Imports;

use App\Models\ImportedData;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithColumnLimit;

class CSVImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithColumnLimit
{
    use Importable, SkipsFailures;

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
            'name_set' => $row['nameset'],
            'title' => $row['title'],
            'given_name' => $row['givenname'],
            'middle_initial' => $row['middleinitial'],
            'surname' => $row['surname'],
            'street_address' => $row['streetaddress'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip_code' => $row['zipcode'],
            'country' => $row['country'],
            'email_address' => $row['emailaddress'],
            'password' => $row['password'],
            'username' => $row['username'],
            'browser_user_agent' => $row['browseruseragent']
        ]);
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'givenname' => 'required', 
            'surname' => 'required',

            // Can also use callback validation rules
            // 'username' => function($attribute, $value, $onFailure) {
            //     is_null($value) ? $onFailure('Cell ' , $attribute , ' is empty.') : "";
            // },   
            // 'givenname' => function($attribute, $value, $onFailure) {
            //     is_null($value) ? $onFailure('Cell ' , $attribute , ' is empty.') : "";
            // },   
            // 'surname' => function($attribute, $value, $onFailure) {
            //     is_null($value) ? $onFailure('Cell ' , $attribute , ' is empty.') : "";
            // },   
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'username.required' => 'Cell :attribute is empty.',
            'givenname.required' => 'Cell :attribute is empty.',
            'surname.required' => 'Cell :attribute is empty.',
        ];
    }

    // /**
    //  * @param Failure[] $failures
    //  */
    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    //     $failures['row'] = '1';
    // }

    public function endColumn(): string
    {
       return 'AX';
    }
}
