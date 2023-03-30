<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\AtributKriteria;
use App\Models\BobotGejala;
use App\Models\Kriteria;
use App\Models\NewKriteria;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Jika Request dengan Menggunakan Data Ajax atau Datatables
        if(request()->ajax()) {
             // Fungsi ini menampilkan data kriteria berdasarkan waktu terbaru
            $user_id = $this->user_id;
            $models = NewKriteria::with(['alternatif', 'atribut_kriteria', 'bobot_gejala'])->orderBy('id', 'ASC')->get();
           
            // ini berfungsi untuk menampilkan data kriteria ke dalam datatables melalui ajax jquery
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models) {
                // Fungsi ini adalah button ubah dan hapus kriteria
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<button type="button" value="'.$models->id.'" class="edit_kriteria btn btn-primary btn-sm" data-toggle="modal" data-target="#editKriteria"><span><i class="fa fa-pencil-alt"></i></span> Edit</button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])    
            ->make(true);
        }

         // untuk memanggil file index kriteria yang ada di dalam folder resources/view/admin/kriteria/index
        return view('admin.kriteria.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
         // Untuk mendapatkan data kriteria sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $kriteria = NewKriteria::where('id', $id)->first();
        // Untuk mendapatkan seluruh data alternatif
        $alternatif_all = Alternatif::get();
        // Untuk mendapatkan seluruh data atribut kriteria
        $atr_kriteria_all = AtributKriteria::get();
        // Untuk mendapatkan seluruh data bobot preferensi
        $bobot_pref = BobotGejala::get();

        //cek apakah data yang dicari ditemukan, jika ya return response dalam json format status 200 diikuti dengan data yang ingin ditampilkan dalam modal edit
        if($kriteria)
        {
            return response()->json([
                'status'=> 200,
                'kriteria'=> $kriteria,
                'alternatif_all'=> $alternatif_all,
                'atr_kriteria_all'=> $atr_kriteria_all,
                'bobot_pref'=> $bobot_pref
            ]);
        }
        // jika tidak ditemukan return response dalam json format status 400 diikuti dengan messages not found
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Kriteria Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //untuk memvalidasi input yang dikirimkan oleh user
        $validator = Validator::make($request->all(),[
            'nama_alternatif'=>'required',
            'deskripsi_kriteria'=>'required|max:100',
            'atribut_kriteria'=>'required',
            'bobot_preferensi'=>'required'
        ]);

        $alternatif_id = $request->nama_alternatif;
        $atribut_id = $request->atribut_kriteria;
        $bobot_id = $request->bobot_preferensi;

        // Jika validasi gagal maka send response 400 dengan error message
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        //jika validasi berhasil maka run query untuk mengupdate data kriteria
        }else{
            $model = NewKriteria::find($id);
            if($model){
                $model->alternatif_id = (int)$alternatif_id;
                $model->kriteria_atribut_id = (int)$atribut_id;
                $model->kriteria_bobot_id = (int)$bobot_id;
                $model->kriteria_nama = $request->deskripsi_kriteria;
                $model->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Data updated successfully',
                ]);
            } else {
                return response()->json([
                    'status'=>400,
                    'message'=>'Kriteria not found',
                ]);
            }
        }
    }
}
