<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use App\Models\MatriksPostNorm;
use App\Models\MatriksPreNorm;
use App\Models\NewAlternatifNilai;
use App\Models\NewKriteria;
use App\Models\NilaiGejala;
use App\Models\NewUser;
use App\Models\NilaiSaw;
use App\Models\ScoreBAI;
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
            // $this->user_role = Auth::user()->is_role;

            return $next($request);
        });
    }

    public function index()
    {
         // Jika Request dengan Menggunakan Data Ajax atau Datatables
        if(request()->ajax()) {
             // Fungsi ini menampilkan data kriteria berdasarkan waktu terbaru
            $models = NewUser::orderBy('id', 'DESC')->get();
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
                $button .= '<a href="'.route('perhitungan.detail', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> Lihat</a>';
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

    public function detail($id_user){
        $user_id = $id_user;
        
        $alternatif_nilai = NewAlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user_id)->get();
        $nilai_bai = ScoreBAI::with('user')->where('user_id', $user_id)->join('level_hasil_bai', 'score_bai.bai_lvl_code', 'level_hasil_bai.code_bai')->first();
        $pre_norm = MatriksPreNorm::where('user_id',  $user_id)->first()->toArray();
        $post_norm = MatriksPostNorm::where('user_id',  $user_id)->first()->toArray();
        $hasil_saw = NilaiSaw::where('user_id', $user_id)->first();

        foreach ($alternatif_nilai as $index=>$an) {
            $alternatif = Alternatif::where('id', $an->kriteria->alternatif_id)->value('alternatif_nama');
            $nilai_gejala = NilaiGejala::where('id', $an->kriteria_nilai_id)->value('nilai_gejala');
            $ket_gejala = NilaiGejala::where('id', $an->kriteria_nilai_id)->value('keterangan_gejala');
            $kriteria = NewKriteria::where('id', $index+1)->value('kriteria_nama');
            $arr_alternatif[] = [
                'Kriteria' => $kriteria,
                'Alternatif' => $alternatif,
                'Nilai Gejala' => $nilai_gejala,
                'Keterangan Gejala' => $ket_gejala
            ];
        }

        for ($i = 0; $i < count($pre_norm); $i++) {
            if ($i >= 0 && $i < 6) {
                $val_prn_a1 = $pre_norm['c'.$i+1];
                $val_psn_a1 = $post_norm['c'.$i+1];
                $arr_prn_a1['C'.$i+1] = $val_prn_a1;
                $arr_psn_a1['C'.$i+1] = $val_psn_a1;
            }elseif($i >= 6 && $i < 13){
                $val_prn_a2 = $pre_norm['c'.$i+1];
                $val_psn_a2 = $post_norm['c'.$i+1];
                $arr_prn_a2['C'.$i+1] = $val_prn_a2;
                $arr_psn_a2['C'.$i+1] = $val_psn_a2;
            }elseif($i >= 13 && $i < 17){
                $val_prn_a3 = $pre_norm['c'.$i+1];
                $val_psn_a3 = $post_norm['c'.$i+1];
                $arr_prn_a3['C'.$i+1] = $val_prn_a3;
                $arr_psn_a3['C'.$i+1] = $val_psn_a3;
            }elseif($i >= 17 && $i <= 20){
                $val_prn_a4 = $pre_norm['c'.$i+1];
                $val_psn_a4 = $post_norm['c'.$i+1];
                $arr_prn_a4['C'.$i+1] = $val_prn_a4;
                $arr_psn_a4['C'.$i+1] = $val_psn_a4;
            }
        }

        $saw_val = array(
            "Subjective" => $hasil_saw->saw_a1,
            "Neurophysiology" => $hasil_saw->saw_a2,
            "Autonomic" => $hasil_saw->saw_a3,
            "Panic Related" => $hasil_saw->saw_a4
         );
        
        $max_saw = max($saw_val);
        $detail_saw = array_search($max_saw, $saw_val);
        
        $desc_hasil = array(
            "Nama" => $nilai_bai->user->nama,
            "Email" => $nilai_bai->user->email,
            "Umur" => $nilai_bai->user->umur,
            "Hasil Bai" => $nilai_bai->total_score,
            "Level Bai" => $nilai_bai->level_bai,
            "Detail SAW" => $detail_saw,
            "Max SAW" => $max_saw,
            "Tanggal" => $nilai_bai->created_at
        );
        
        
        return view('admin.perhitungan.detail', [
            'desc_hasil' => $desc_hasil,
            'arr_alternatif' => $arr_alternatif,
            'arr_prn_a1' => $arr_prn_a1,
            'arr_prn_a2' => $arr_prn_a2,
            'arr_prn_a3' => $arr_prn_a3,
            'arr_prn_a4' => $arr_prn_a4,
            'arr_psn_a1' => $arr_psn_a1,
            'arr_psn_a2' => $arr_psn_a2,
            'arr_psn_a3' => $arr_psn_a3,
            'arr_psn_a4' => $arr_psn_a4,
            'saw_val' => $saw_val
        ]);
    }

    // public function pdf()
    // {

    //     $kriterias = Kriteria::orderBy('id','ASC')->get();

    //     $alternatif_nilais = AlternatifNilai::select([
    //         'alternatifs.id as kode_alternatif',
    //         'alternatifs.alternatif_nama as nama_alternatif',
    //         'alternatifs.alternatif_image as image_alternatif',
    //         'alternatif_nilais.kriteria_id as kode_kriteria',
    //         'alternatif_nilais.nilai_kriteria_id as kode_nilai_kriteria'
    //     ])
    //     ->join('alternatifs', 'alternatifs.id','=','alternatif_nilais.alternatif_id')
    //     ->join('kriterias', 'kriterias.id','=','alternatif_nilais.kriteria_id')
    //     ->orderBy('alternatifs.id','ASC')
    //     ->orderBy('alternatif_nilais.kriteria_id','ASC')
    //     ->groupBy('alternatif_nilais.alternatif_id')
    //     ->get();


    //     $kriteria = Kriteria::all();
    //     $alternatif = Alternatif::all();
    //     $kode_krit = [];
    //     foreach ($kriteria as $krit)
    //     {
    //         $kode_krit[$krit->id] = [];
    //         foreach ($alternatif as $al)
    //         {
    //             foreach ($al->crip as $crip)
    //             {
    //                     if ($crip->kriteria->id == $krit->id)
    //                     {
    //                         $kode_krit[$krit->id][] = $crip->kn_nilai;
    //                     }
    //             }
    //         }

    //         if ($krit->kriteria_atribut == 'cost')
    //         {
    //             $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
    //         } elseif ($krit->kriteria_atribut == 'benefit')
    //         {
    //             $kode_krit[$krit->id] = max($kode_krit[$krit->id]);
    //         }
    //     };
      
    //     $pdf = PDF::loadView('admin.perhitungan.pdf', compact('kriterias','alternatif_nilais','kriteria','alternatif','kode_krit'))->setPaper('a4', 'potrait');

       
    //     return $pdf->stream();
    // }
}
