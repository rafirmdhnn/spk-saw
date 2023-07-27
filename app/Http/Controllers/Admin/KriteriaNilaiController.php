<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\KriteriaNilai;
use App\Models\NilaiGejala;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class KriteriaNilaiController extends Controller
{
    public $user_id;
    public $user_role;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;

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
            $models = NilaiGejala::get();

            // ini berfungsi untuk menampilkan data kriteria ke dalam datatables melalui ajax jquery
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models) {
                // Fungsi ini adalah button ubah dan hapus kriteria
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<button type="button" value="'.$models->id.'" class="edit_nilaiKriteria btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_nilaiKriteria"><span><i class="fa fa-pencil-alt"></i></span> Edit</button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])    
            ->make(true);
        }


        return view('admin.kriterianilai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
        
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Untuk mendapatkan data kriteria sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $kriteriaNilai = NilaiGejala::where('id', $id)->first();

        if($kriteriaNilai)
        {
            return response()->json([
                'status'=> 200,
                'kriteriaNilai'=> $kriteriaNilai
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Kriteria Nilai Not Found'
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
        // membuat custom message untuk setiap validasi dari request yang dikirimkan user
        $messages = [
            'keterangan_nilai.required' => 'Keterangan nilai kriteria harus diisi',
            'nilai.required' => 'Nilai kriteria harus diisi',
            'nilai.numeric' => 'Nilai kriteria hanya dapat diisi oleh angka'
        ];
        //untuk memvalidasi input yang dikirimkan oleh user
        $validator = Validator::make($request->all(),[
            'keterangan_nilai'=>'required|max:190',
            'nilai'=>'required|numeric'
        ], $messages);
        
        // //initiate variable untuk menampung request yang diperoleh
        // $keterangan_nilai = $request->keterangan_nilai;
        // $nilai = $request->nilai;

        // if data validate is false then send response 400 with error message
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        // if data validate is true then run the query to update the data kriteria
        }else{
            $model = NilaiGejala::find ($id);
            if($model){
                $model->keterangan_gejala = $request->keterangan_nilai;
                $model->nilai_gejala = $request->nilai;
                $model->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Data updated successfully',
                ]);
            } else {
                return response()->json([
                    'status'=>400,
                    'message'=>'Nilai Kriteria not found',
                ]);
            }
        }
    }
}
