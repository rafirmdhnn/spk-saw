<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // set datetime to Jakarta time
        date_default_timezone_set("Asia/Jakarta");

        // insert data to the table administrator
        DB::table('administrator')->insert([
            'name' => 'Admin 3',
            'email' => 'admin3@test.com',
            'password' => Hash::make('Adminnn12345'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
