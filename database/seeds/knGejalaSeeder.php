<?php

use Illuminate\Database\Seeder;

class knGejalaSeeder extends Seeder
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
                "keterangan_gejala" => "Tidak sama sekali",
                "nilai_gejala" => 0,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "keterangan_gejala" => "Ringan tetapi tidak banyak mengganggu saya",
                "nilai_gejala" => 1,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "keterangan_gejala" => "Sedang: kadang-kadang saya tidak nyaman",
                "nilai_gejala" => 2,
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "keterangan_gejala" => "Berat: banyak mengganggu saya",
                "nilai_gejala" => 3,
                "created_at" => date("Y:m:d H:i:s")
            ]
        ];


        // insert data to table nilai_gejala
        DB::table('nilai_gejala')->insert($data);
    }
}
