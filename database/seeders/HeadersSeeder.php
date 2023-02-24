<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('headers')->insert([
            ['name' => 'number', 'oryginal_name' => 'Number'],
            ['name' => 'gender', 'oryginal_name' => 'Gender'],
            ['name' => 'name_set', 'oryginal_name' => 'NameSet'],
            ['name' => 'title', 'oryginal_name' => 'Title'],
            ['name' => 'given_name', 'oryginal_name' => 'GivenName'],
            ['name' => 'middle_initial', 'oryginal_name' => 'MiddleInitial'],
            ['name' => 'surname', 'oryginal_name' => 'Surname'],
            ['name' => 'street_address', 'oryginal_name' => 'StreetAddress'],
            ['name' => 'city', 'oryginal_name' => 'City'],
            ['name' => 'state', 'oryginal_name' => 'State'],
            ['name' => 'zip_code', 'oryginal_name' => 'ZipCode'],
            ['name' => 'country', 'oryginal_name' => 'Country'],
            ['name' => 'email_address', 'oryginal_name' => 'EmailAddress'],
            ['name' => 'password', 'oryginal_name' => 'Password'],
            ['name' => 'username', 'oryginal_name' => 'Username'],
            ['name' => 'browser_user_agent', 'oryginal_name' => 'BrowserUserAgent']
        ]);
    }
}
