<?php

use Illuminate\Database\Seeder;

class kriteriaNilaiSeeder extends Seeder
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

        $num_question = 21;
        $num_answers = 4;

        $data = [];
        $input = [];
        for ($i = 1; $i <= $num_question; $i++)
        {
          for($j = 1; $j <= $num_answers; $j++ )
          {
            $inp_data = array(
             'kriteria_id' => $i,
             'kn_gejala_id' => $j,
             'created_at' => date("Y-m-d H:i:s")
            );
             array_push($input, $inp_data);
          }
        }
        array_push($data, $input);

        // insert data to table kriteria_nilai
        foreach($data as $item){
            DB::table('kriteria_nilai')->insert($item);
        }

    }
}
