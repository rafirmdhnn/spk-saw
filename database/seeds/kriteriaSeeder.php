<?php

use Illuminate\Database\Seeder;

class kriteriaSeeder extends Seeder
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
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Sulit untuk rileks",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Takut sesuatu yang buruk akan terjadi",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Merasa ketakutan",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Merasa gugup",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Takut hilang kendali",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 1,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 1,
                "kriteria_nama" => "Ciut mental",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Kibas-kibas atau kesemutan",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Lemas atau goyah pada kaki",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Tangan gemetaran",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Goyah atau tidak tahan berdiri",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Pingsan atau perasaan mau pingsan",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Badan gemetar atau goyah",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 2,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 2,
                "kriteria_nama" => "Pusing atau kepala terasa berat",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 3,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 3,
                "kriteria_nama" => "Perasaan panas",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 3,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 3,
                "kriteria_nama" => "Wajah merona memerah",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 3,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 3,
                "kriteria_nama" => "Pencernaan atau perut terganggu",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 3,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 3,
                "kriteria_nama" => "Keringat panas atau dingin",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 4,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 4,
                "kriteria_nama" => "Jantung berdebar-debar kencang",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 4,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 4,
                "kriteria_nama" => "Perasaan tercekik atau tersedak",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 4,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 4,
                "kriteria_nama" => "Kesulitan bernafas",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "alternatif_id" => 4,
                "kriteria_atribut_id" => 1,
                "kriteria_bobot_id" => 4,
                "kriteria_nama" => "Takut akan sekarat (kematian)",
                "created_at" => date("Y-m-d H:i:s")
            ]
        ];

        // insert data to table kriteria
        DB::table('kriteria')->insert($data);

    }
}
