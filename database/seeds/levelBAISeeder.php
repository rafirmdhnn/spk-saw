<?php

use Illuminate\Database\Seeder;

class levelBAISeeder extends Seeder
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
                "code_bai" => "low",
                "level_bai" => "Tingkat Kecemasan Rendah (Low Anxiety)",
                "detail_bai" => "Anda jarang merasa cemas atau khawatir. Akan tetapi bisa jadi Anda belum menyadari gejala atau menutup diri dari gejala yang Anda rasakan. Terlalu rendah tingkat kecemasan juga dapat menunjukkan bahwa Anda kurang peduli atas diri sendiri, orang lain, atau lingkungan Anda.",
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "code_bai" => "med",
                "level_bai" => "Tingkat Kecemasan Sedang (Moderate Anxiety)",
                "detail_bai" => "Tampaknya Anda mengalami kecemasan secara teratur. Perhatikan pola kapan dan mengapa Anda mengalami gejalanya. Misalnya, jika itu terjadi sebelum berbicara di depan umum atau pekerjaan Anda membutuhkan banyak presentasi, Anda mungkin akan menemukan cara untuk menenangkan diri Anda sendiri sebelum berbicara atau biarkan orang lain melakukan beberapa presentasi. Anda mungkin memiliki beberapa masalah konflik yang perlu diselesaikan. Anda mungkin bisa berkonsultasi dengan spesialis jika gejala terus berlanjut.",
                "created_at" => date("Y:m:d H:i:s")
            ],
            [
                "code_bai" => "high",
                "level_bai" => "Tingkat Kecemasan Berat (Severe Anxiety)",
                "detail_bai" => "Anda sering dan mudah sekali cemas. Perhatikan pola atau waktu ketika Anda cenderung merasakan gejalanya. Kecemasan yang terus-menerus dan tinggi bukanlah tanda kelemahan pribadi atau kegagalan. Namun, itu adalah sesuatu yang perlu ditangani secara proaktif atau mungkin ada dampak signifikan terhadap Anda secara mental dan fisik. Anda mungkin bisa berkonsultasi dengan spesialis jika gejala terus berlanjut.",
                "created_at" => date("Y:m:d H:i:s")
            ]
        ];


        // insert data to table nilai_gejala
        DB::table('level_hasil_bai')->insert($data);
    }
}