<?php

namespace App\Http\Controllers;

use App\Models\BobotGejala;
use App\Models\NewAlternatifNilai;
use App\Models\MatriksPreNorm;
use App\Models\NilaiSaw;
use App\Models\MatriksPostNorm;
use App\Models\NilaiGejala;
use App\Models\NewKriteria;
use App\Models\ScoreBAI;
use App\Models\NewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function index() {
        return view('user.home');
    }


    public function question() {
        $questions = NewKriteria::with('nilai_gejala', 'kriteria_nilai')->get();
        

        return view('user.question', compact('questions'));
    }

    public function questionStore(Request $request) {
        $request->validate([
            'name'   => 'required',
            'umur'   => 'required',
            'email'  => 'required|email|unique:user,email'
        ]);

        //insert data user
        $user = new NewUser();
        $user->nama = $request->name;
        $user->umur = $request->umur;
        $user->email = $request->email;
        $user->save();

        
        //insert data from input user to table alternatif nilai
        $total = 0;
        for ($i = 0; $i < count($request->questions); $i++) {
            $total += $request->nilai[$i];
            $id = $user->id;
            $answers[] = [
                'user_id' => $user->id,
                'kriteria_id' => $request->questions[$i],
                'kriteria_nilai_id' => $request->answers[$i+1]
            ];
        }
        //insert data kedalam tabel alternatif nilai
        NewAlternatifNilai::insert($answers);

        //calculate bai score dengan memanggil fungsi calculateBAIScore
        $bai_cal = $this->calculateBAIScore($user->id);

        // insert score bai kedalam tabel score bai
        $bai = new ScoreBAI();
        $bai->user_id = $user->id;
        $bai->bai_lvl_code = $bai_cal["level_bai"];
        $bai->total_score = $bai_cal["total_bai"];
        $bai->save();

        //insert data kedalam tabel matriks_prenorm
        $pre_norm = new MatriksPreNorm();
        $pre_norm->user_id = $user->id;
        foreach($bai_cal['data_prenorm'] as $index=>$val_prenorm){
            $pre_norm->$index = $val_prenorm;
        }
        $pre_norm->save();

        //calculate saw score dengan memanggil fungsi calculateSaw
        $saw_cal = $this->calculateSaw($user->id);
        
        //insert data kedalam tabel matriks_postnorm
        $post_norm = new MatriksPostNorm();
        $post_norm->user_id = $user->id;
        foreach($saw_cal['arr_postnorm'] as $index=>$val_postnorm){
            $post_norm->$index = $val_postnorm;
        }
        $post_norm->save();
        
        //insert data hasil perhitungan saw kedalam tabel hasil saw
        $hasil_saw = new NilaiSaw();
        $hasil_saw->user_id = $user->id;
        $hasil_saw->saw_a1 = $saw_cal['sum_saw_a1'];
        $hasil_saw->saw_a2 = $saw_cal['sum_saw_a2'];
        $hasil_saw->saw_a3 = $saw_cal['sum_saw_a3'];
        $hasil_saw->saw_a4 = $saw_cal['sum_saw_a4'];
        $hasil_saw->save();

        return redirect()->route('result', $id)
        ->with('success','Result successfully');
    }

    public function calculateBAIScore($id){
        $user_id = $id;
         
        //get data alternatif nilai for the user
        $data = NewAlternatifNilai::with(['user','kriteriaNilai'])->where('user_id',$user_id)->get();
        #score BAI

        //get id of table nilai gejala
        // foreach($data as $d){
        //     $id_nilai[] = $d->kriteria_nilai_id;
        // }

        //get nilai gejala and count the total score BAI for the user
        $total_BAI = 0;
        // $insert_val = array();
        foreach ($data as $index=>$d) {
            $nilai_gejala = NilaiGejala::where('id', $d->kriteria_nilai_id)->value('nilai_gejala');
            // untuk menghitung total BAI score dari jawaban responden
            $total_BAI += $nilai_gejala;
            // menyimpan nilai dari jawaban responden kedalam array untuk disimpan ke table matriks_prenorm
            $insert_val['c'.$index+1] = $nilai_gejala;
        }

        // merge array untuk disimpan kedalam table matriks_prenorm
        // $test_id['user_id'] = $id;
        // $data_prenorm = array_merge($insert_val);

        //define the result of the BAI scores for the user
        if($total_BAI >= 0 && $total_BAI <= 21){
            $level_bai = "low";
        }elseif($total_BAI >= 22 && $total_BAI <= 35){
            $level_bai = "med";
        }elseif($total_BAI >= 36 && $total_BAI <= 63){
            $level_bai = "high";
        }

        return array('total_bai' => $total_BAI, 'level_bai' => $level_bai, 'data_prenorm' => $insert_val);
    }


    public function result($id) {
        $user_id = $id;

        $hasil_bai = ScoreBAI::select('score_bai.total_score', 'level_hasil_bai.level_bai', 'level_hasil_bai.detail_bai')
                    ->where('user_id', $id)
                    ->join('level_hasil_bai', 'score_bai.bai_lvl_code', 'level_hasil_bai.code_bai')
                    ->first();
        
        $hasil_saw = NilaiSaw::where('user_id', $user_id)->first();
        $saw_val = array(
            "Subjective" => $hasil_saw->saw_a1,
            "Neurophysiology" => $hasil_saw->saw_a2,
            "Autonomic" => $hasil_saw->saw_a3,
            "Panic Related" => $hasil_saw->saw_a4
         );
        
         $max_value = max($saw_val); // Get the maximum value
         $best_saw = array(); // Initialize an empty array to store the arrays with the maximum value
        
        if ($max_value > 0 ) {
            foreach ($saw_val as $key => $value) {
                if ($value == $max_value) {
                    $best_saw[$key] = $value; // Add the key-value pair to the $best_saw array if the value matches the maximum value
                }
            }
    
            // $max_saw = max($saw_val);
            // $detail_saw = array_search($best_saw, $saw_val);
            $empty_saw = false;
        }else{
            $empty_saw = true;
        }
     
        // dd($empty_saw);

        return view('user.result', [ 'user_id' => $user_id, 'hasil_bai' => $hasil_bai, 'saw_val' => $saw_val, 'best_saw' => $best_saw, 'empty_saw' => $empty_saw]);
    }

    public function calculateSaw($id){
        #array nilai kriteria setiap alternatif sebelum normalisasi
        $matrix1 = [];
        $matrix2 = [];
        $matrix3 = [];
        $matrix4 = [];
        #array nilai kriteria setiap alternatif setelah normalisasi
        $arr_n1 = [];
        $arr_n2 = [];
        $arr_n3 = [];
        $arr_n4 = [];
        #array nilai perhitungan saw
        $saw_a1 = [];
        $saw_a2 = [];
        $saw_a3 = [];
        $saw_a4 = [];

        $user_id =  $id;

        $data = NewAlternatifNilai::with(['user', 'kriteria','kriteriaNilai'])->where('user_id',$user_id)->get();
        $arr_prenorm = MatriksPreNorm::where('user_id',  $user_id)->first()->toArray();

        $bobot_pref = array();
        //get bobot preferensi
        foreach($data as $index => $d){
            $bobot_pref[$index] = BobotGejala::where('id', $d->kriteria->kriteria_bobot_id)->value('bobot');
        }

        //membentuk matriks per alternatif untuk di normalisasi
        for ($i = 0; $i < count($bobot_pref); $i++) {
            if ($i >= 0 && $i < 6) {
                $kn_nilai_a1 = $arr_prenorm['c'.$i+1];
                $bobot_a1 = $bobot_pref[$i];
                $matrix1[] = 
                [
                   'Kriteria' => 'c'.$i+1,
                   'Nilai gejala' => $kn_nilai_a1,
                   'Bobot preferensi' => $bobot_a1
                ];
                $max_a1 = max(array_column($matrix1, 'Nilai gejala'));
            }elseif($i >= 6 && $i < 13){
                $kn_nilai_a2 = $arr_prenorm['c'.$i+1];
                $bobot_a2 = $bobot_pref[$i];
                $matrix2[] = 
                [
                   'Kriteria' => 'c'.$i+1,
                   'Nilai gejala' => $kn_nilai_a2,
                   'Bobot preferensi' => $bobot_a2
                ];
                $max_a2 = max(array_column($matrix2, 'Nilai gejala'));
            }elseif($i >= 13 && $i < 17){
                $kn_nilai_a3 = $arr_prenorm['c'.$i+1];
                $bobot_a3 = $bobot_pref[$i];
                $matrix3[] = 
                [
                   'Kriteria' => 'c'.$i+1,
                   'Nilai gejala' => $kn_nilai_a3,
                   'Bobot preferensi' => $bobot_a3
                ];
                $max_a3 = max(array_column($matrix3, 'Nilai gejala'));
            }elseif($i >= 17 && $i <= 20){
                $kn_nilai_a4 = $arr_prenorm['c'.$i+1];
                $bobot_a4 = $bobot_pref[$i];
                $matrix4[] = 
                [
                   'Kriteria' => 'c'.$i+1,
                   'Nilai gejala' => $kn_nilai_a4,
                   'Bobot preferensi' => $bobot_a4
                ];
                $max_a4 = max(array_column($matrix4, 'Nilai gejala'));
            }
        }

        //melakukan normalisasi pada matrix yg terbentuk sebelumnya
        foreach ($matrix1 as $mx_1) {  
            if($max_a1 > 0){
                $matrix_n1 = number_format($mx_1['Nilai gejala']/$max_a1, 2, '.', ',');
                $saw_a1[] = number_format($matrix_n1*$mx_1['Bobot preferensi'], 2, '.', ',');
                $arr_n1[$mx_1['Kriteria']] = $matrix_n1; 
            }else{
                $saw_a1[] = number_format(0, 2, '.', ',');
                $arr_n1[$mx_1['Kriteria']] = number_format(0, 2, '.', ',');
            }
        }
        foreach ($matrix2 as $mx_2) {  
            if($max_a2 > 0){
                $matrix_n2 = number_format($mx_2['Nilai gejala']/$max_a2, 2, '.', ',');
                $saw_a2[] = number_format($matrix_n2*$mx_2['Bobot preferensi'], 2, '.', ',');
                $arr_n2[$mx_2['Kriteria']] = $matrix_n2; 
            }else{
                $saw_a2[] = number_format(0, 2, '.', ',');
                $arr_n2[$mx_2['Kriteria']] = number_format(0, 2, '.', ',');
            }
        }
        foreach ($matrix3 as $mx_3) { 
            if($max_a3 > 0){
                $matrix_n3 = number_format($mx_3['Nilai gejala']/$max_a3, 2, '.', ',');
                $saw_a3[] = number_format($matrix_n3*$mx_3['Bobot preferensi'], 2, '.', ',');
                $arr_n3[$mx_3['Kriteria']] = $matrix_n3; 
            }else{
                $saw_a3[] = number_format(0, 2, '.', ',');
                $arr_n3[$mx_3['Kriteria']] = number_format(0, 2, '.', ',');
            }
        }
        foreach ($matrix4 as $mx_4) {  
            if($max_a4 > 0){
                $matrix_n4 = number_format($mx_4['Nilai gejala']/$max_a4, 2, '.', ',');
                $saw_a4[] = number_format($matrix_n4*$mx_4['Bobot preferensi'], 2, '.', ',');
                $arr_n4[$mx_4['Kriteria']] = $matrix_n4; 
            }else{
                $saw_a4[] = number_format(0, 2, '.', ',');
                $arr_n4[$mx_4['Kriteria']] = number_format(0, 2, '.', ',');
            }
        }
        //merge matriks normalisasi kedalam satu array untuk keperluan insert data ke tabel matriks_postnorm
        $arr_postnorm = array_merge($arr_n1, $arr_n2, $arr_n3, $arr_n4);
    
        #menjumlahkan perhitungan preferensi (V) dari tiap Aspek
        $sum_saw_a1 = number_format(array_sum($saw_a1), 2, '.', ',');
        $sum_saw_a2 = number_format(array_sum($saw_a2), 2, '.', ',');
        $sum_saw_a3 = number_format(array_sum($saw_a3), 2, '.', ',');
        $sum_saw_a4 = number_format(array_sum($saw_a4), 2, '.', ',');

        #menentukan hasil saw terbaik
        $saw_total = array(
            "Subjective" => $sum_saw_a1,
            "Neurophysiology" => $sum_saw_a2,
            "Autonomic" => $sum_saw_a3,
            "Panic Related" => $sum_saw_a4
         );
         
        $best_saw = max($saw_total);
        $detail_saw = array_keys($saw_total, $best_saw);

        $params = array(
            "arr_postnorm" => $arr_postnorm,
            "sum_saw_a1" => $sum_saw_a1,
            "sum_saw_a2" => $sum_saw_a2,
            "sum_saw_a3" => $sum_saw_a3,
            "sum_saw_a4" => $sum_saw_a4,
            "best_saw" => $best_saw,
            "detail_saw" => $detail_saw,
            "saw_total" => $saw_total
        ); 

        return $params;
    }
}