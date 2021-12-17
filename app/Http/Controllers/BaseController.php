<?php

namespace App\Http\Controllers;

use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use App\Models\KriteriaNilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function index() {
        return view('user.home');
    }


    public function question() {
        $questions = Kriteria::with('kriteria_nilai')->get();

        return view('user.question', compact('questions'));
    }

    public function questionStore(Request $request) {
        $request->validate([
            'name'   => 'required',
            'umur'   => 'required',
            'email'  => 'required|email|unique:users,email'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->umur = $request->umur;
        $user->email = $request->email;
        $user->save();

        $nilai = $request->all();

        $total = 0;
        for ($i = 0; $i < count($request->questions); $i++) {
            $total += $request->nilai[$i];
            $id = $user->id;
            $answers[] = [
                'user_id' => $user->id,
                'kriteria_id' => $request->questions[$i],
                'nilai_kriteria_id' => $request->answers[$i+1]
            ];
        }
    
        AlternatifNilai::insert($answers);

        return redirect()->route('result', $id)
        ->with('success','Result successfully');
    }


    public function result($id) {
        $user_id = $id;
        
        $score = AlternatifNilai::with(['user','kriteriaNilai'])->where('user_id',$user_id)->get();
        return view('user.result', ['score' => $score, 'user_id' => $user_id]);
    }


    public function calculateSaw($data){
        $input =  $data;

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

        #score BAI
        $total_BAI = 0;
        foreach ($input as $score) {
            $total_BAI += $score->kriteriaNilai->kn_nilai;
        }
        if($total_BAI >= 0 && $total_BAI <= 21){
            $detail_BAI = "Tingkat Kecemasan Rendah (Low Anxiety)";
        }elseif($total_BAI >= 22 && $total_BAI <= 35){
            $detail_BAI = "Tingkat Kecemasan Sedang (Moderate Anxiety)";
        }elseif($total_BAI >= 36 && $total_BAI <= 63){
            $detail_BAI = "Tingkat Kecemasan Berat (Severe Anxiety)";
        }

        #mengubah set data kedalam matrix per alternatif
        foreach ($input as $index => $a) {
            switch ($a) {
                case ($a->kriteria->alternatif_id == 1):
                    $matrix1[] = $a->kriteriaNilai->kn_nilai;
                    $max_a1 = max($matrix1);
                    $bobot_a1 = $a->kriteria->kriteria_bobot;
                    break;
                case ($a->kriteria->alternatif_id == 2):
                    $matrix2[] = $a->kriteriaNilai->kn_nilai;
                    $max_a2 = max($matrix2);
                    $bobot_a2 = $a->kriteria->kriteria_bobot;
                    break;
                case ($a->kriteria->alternatif_id == 3):
                    $matrix3[] = $a->kriteriaNilai->kn_nilai;
                    $max_a3 = max($matrix3);
                    $bobot_a3 = $a->kriteria->kriteria_bobot;
                    break;
                case ($a->kriteria->alternatif_id == 4):
                    $matrix4[] = $a->kriteriaNilai->kn_nilai;
                    $max_a4 = max($matrix4);
                    $bobot_a4 = $a->kriteria->kriteria_bobot;
                    break;
                default:
                    break;
            }
        }

        #melakukan normalisasi pada matrix yg terbentuk sebelumnya
        foreach ($matrix1 as $mx_1) {  
            if($max_a1 > 0){
                $matrix_n1 = number_format($mx_1/$max_a1, 2, '.', ',');
                $saw_a1[] = number_format($matrix_n1*$bobot_a1, 2, '.', ',');
                $arr_n1[] = $matrix_n1; 
            }
        }
        foreach ($matrix2 as $mx_2) {  
            if($max_a2 > 0){
                $matrix_n2 = number_format($mx_2/$max_a2, 2, '.', ',');
                $saw_a2[] = number_format($matrix_n2*$bobot_a2, 2, '.', ',');
                $arr_n2[] = $matrix_n2; 
            }
        }
        foreach ($matrix3 as $mx_3) { 
            if($max_a3 > 0){
                $matrix_n3 = number_format($mx_3/$max_a3, 2, '.', ',');
                $saw_a3[] = number_format($matrix_n3*$bobot_a3, 2, '.', ',');
                $arr_n3[] = $matrix_n3; 
            }
        }
        foreach ($matrix4 as $mx_4) {  
            if($max_a4 > 0){
                $matrix_n4 = number_format($mx_4/$max_a4, 2, '.', ',');
                $saw_a4[] = number_format($matrix_n4*$bobot_a4, 2, '.', ',');
                $arr_n4[] = $matrix_n4; 
            }
        }

        #menjumlahkan perhitungan preferensi (V) dari tiap Aspek
        $sum_saw1 = number_format(array_sum($saw_a1), 2, '.', ',');
        $sum_saw2 = number_format(array_sum($saw_a2), 2, '.', ',');
        $sum_saw3 = number_format(array_sum($saw_a3), 2, '.', ',');
        $sum_saw4 = number_format(array_sum($saw_a4), 2, '.', ',');

        #menentukan hasil saw terbaik

        $saw_total = array(
            "Subjective" => $sum_saw1,
            "Neurophysiology" => $sum_saw2,
            "Autonomic" => $sum_saw3,
            "Panic Related" => $sum_saw4
            // array('saw' => $sum_saw1, 'aspek' => "Subjective"),
            // array('saw' => $sum_saw2, 'aspek' => "Neurophysiology"),
            // array('saw' => $sum_saw3, 'aspek' => "Autonomic"),
            // array('saw' => $sum_saw4, 'aspek' => "Panic Related")
         );
         
        $best_saw = max($saw_total);
        $detail_saw = array_keys($saw_total, $best_saw);

        // if ($best_saw = 'a1'){
        //     $detail_saw = "Subjective";
        // }elseif($best_saw = 'a2'){
        //     $detail_saw = "Neurophysiology";
        // }elseif($best_saw = 'a3'){
        //     $detail_saw = "Autonomic";
        // }elseif($best_saw = 'a4'){
        //     $detail_saw = "Panic Related";
        // }

        $params = array(
            "matrix1" => $matrix1,
            "matrix2" => $matrix2,
            "matrix3" => $matrix3,
            "matrix4" => $matrix4,
            "arr_n1" => $arr_n1,
            "arr_n2" => $arr_n2,
            "arr_n3" => $arr_n3,
            "arr_n4" => $arr_n4,
            "saw_a1" => $sum_saw1,
            "saw_a2" => $sum_saw2,
            "saw_a3" => $sum_saw3,
            "saw_a4" => $sum_saw4,
            "detail_BAI" => $detail_BAI,
            "total_BAI" => $total_BAI,
            "best_saw" => $best_saw,
            "detail_saw" => $detail_saw,
            "saw_total" => $saw_total
        ); 

        return $params;
    }

    public function detail($id){
        $user = $id;

        $an = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)->get();
        $user = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)->first();
        $saw = $this->calculateSaw($an);       
        // $alternatif1 = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)
        // ->whereHas('kriteria', function ($query){
        //     $query->where('alternatif_id','1');
        // })->get();
        // $alternatif2 = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)
        // ->whereHas('kriteria', function ($query){
        //     $query->where('alternatif_id','2');
        // })->get();
        // $param = array(
        //     "an" => $an,
        //     "alternatif1" => $alternatif1,
        //     "alternatif2" => $alternatif2
        // );
        
    	 return view('user.saw', ['an' => $an, 'user' => $user,'saw' => $saw]);
    }
}
