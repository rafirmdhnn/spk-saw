<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use App\Models\DescriptionAlternatif;
use Illuminate\Http\Request;
use PDF;
use Auth;

class PerhitunganController extends Controller
{

    public $user_id;
    public $user_role;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            $this->user_role = Auth::user()->is_role;

            return $next($request);
        });
        
       
    }

    public function index()
    {
         // Jika Request dengan Menggunakan Data Ajax atau Datatables
        if(request()->ajax()) {
             // Fungsi ini menampilkan data kriteria berdasarkan waktu terbaru
            $user_id = $this->user_id;
            $models = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->groupBy('user_id')->orderBy('id', 'DESC')->get();
            // ini berfungsi untuk menampilkan data kriteria ke dalam datatables melalui ajax jquery
            return datatables()->of($models)
            ->addIndexColumn()
            ->editColumn('created_at', function ($models) {
                return $models->created_at->toDayDateTimeString();
            })
            ->addColumn('action', function ($models) {
                // Fungsi ini adalah button ubah dan hapus kriteria
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('perhitungan.detail', $models->user_id).'" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> Lihat</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action','is_role'])    
            ->make(true);
        }

         // untuk memanggil file index kriteria yang ada di dalam folder resources/view/admin/kriteria/index
        return view('admin.perhitungan.index');
    }


    public function sawCalculate($data){
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
         );

         
        $best_saw = max($saw_total);
        $detail_saw = array_keys($saw_total, $best_saw);

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


    public function detail($id_user){
        $user = $id_user;

        $an = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)->get();
        $user = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)->first();
        $saw = $this->sawCalculate($an);
        
        return view('admin.perhitungan.detail', ['an' => $an, 'user' => $user,'saw' => $saw]);
    }

    public function pdf()
    {

        $kriterias = Kriteria::orderBy('id','ASC')->get();

        $alternatif_nilais = AlternatifNilai::select([
            'alternatifs.id as kode_alternatif',
            'alternatifs.alternatif_nama as nama_alternatif',
            'alternatifs.alternatif_image as image_alternatif',
            'alternatif_nilais.kriteria_id as kode_kriteria',
            'alternatif_nilais.nilai_kriteria_id as kode_nilai_kriteria'
        ])
        ->join('alternatifs', 'alternatifs.id','=','alternatif_nilais.alternatif_id')
        ->join('kriterias', 'kriterias.id','=','alternatif_nilais.kriteria_id')
        ->orderBy('alternatifs.id','ASC')
        ->orderBy('alternatif_nilais.kriteria_id','ASC')
        ->groupBy('alternatif_nilais.alternatif_id')
        ->get();


        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $kode_krit = [];
        foreach ($kriteria as $krit)
        {
            $kode_krit[$krit->id] = [];
            foreach ($alternatif as $al)
            {
                foreach ($al->crip as $crip)
                {
                        if ($crip->kriteria->id == $krit->id)
                        {
                            $kode_krit[$krit->id][] = $crip->kn_nilai;
                        }
                }
            }

            if ($krit->kriteria_atribut == 'cost')
            {
                $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
            } elseif ($krit->kriteria_atribut == 'benefit')
            {
                $kode_krit[$krit->id] = max($kode_krit[$krit->id]);
            }
        };
      
        $pdf = PDF::loadView('admin.perhitungan.pdf', compact('kriterias','alternatif_nilais','kriteria','alternatif','kode_krit'))->setPaper('a4', 'potrait');

       
        return $pdf->stream();
    }
}
