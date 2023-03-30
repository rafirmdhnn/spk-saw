<?php

use Illuminate\Database\Seeder;

class atributKriteriaSeeder extends Seeder
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

        $data = [
            [
                "attribut_kriteria" => 'benefit',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "attribut_kriteria" => 'cost',
                "created_at" => date('Y-m-d H:i:s')
            ]
        ];

        // insert data to table atribut_kriteria
        DB::table('atribut_kriteria')->insert($data);
    }
}
