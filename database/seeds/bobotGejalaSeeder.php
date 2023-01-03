<?php

use Illuminate\Database\Seeder;

class bobotGejalaSeeder extends Seeder
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
                "bobot" => 3.5,
                "alternatif_id" => 1,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "bobot" => 3,
                "alternatif_id" => 2,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "bobot" => 5.25,
                "alternatif_id" => 3,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "bobot" => 5.25,
                "alternatif_id" => 4,
                "created_at" => date("Y:m:d H:i:s")
            ]
        ];

        // insert data to table bobot_gejala
        DB::table('bobot_gejala')->insert($data);
    }
}
