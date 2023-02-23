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
            ['name' => 'number'],
            ['name' => 'gender'],
            ['name' => 'name_set'],
            ['name' => 'title'],
            ['name' => 'given_name'],
            ['name' => 'middle_initial'],
            ['name' => 'surname'],
            ['name' => 'street_address'],
            ['name' => 'city'],
            ['name' => 'state'],
            ['name' => 'zip_code'],
            ['name' => 'country'],
            ['name' => 'email_address'],
            ['name' => 'password'],
            ['name' => 'username'],
            ['name' => 'browser_user_agent']
        ]);
    }
}
