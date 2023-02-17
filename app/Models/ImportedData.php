<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedData extends Model
{
    use HasFactory;

        /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'gender',
        'name_set',
        'title',
        'given_name',
        'middle_initial',
        'surname',
        'street_address',
        'city',
        'state',
        'zip_code',
        'country',
        'email_address',
        'password',
        'username',
        'browser_user_agent',
    ];
}
