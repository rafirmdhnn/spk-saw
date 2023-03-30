<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AtributKriteria;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class AtributKriteriaController extends Controller
{
    public $user_id;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user_id = Auth::user()->id;
        
            return $next($request);
        });
    }

    public function index()
    {
        // Jika request dengan mengguankan data ajax atau datatables
        if(request()->ajax()) {
            $models = AtributKriteria::get();

            // ini berfungsi untuk menampilkan data bobot preferensi ke dalam datatables
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models){
                // Fungsi ini adalah button ubah bobot preferensi
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<button type="button" value="'.$models->id.'" class="edit_atrKriteria btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_atributKriteria"><span><i class="fa fa-pencil-alt"></i></span> Edit</button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.atributkriteria.index');
    }

    public function edit($id)
    {
        // Untuk mendapatkan data kriteria sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $atributKriteria = AtributKriteria::where('id', $id)->first();

        if($atributKriteria)
        {
            return response()->json([
                'status'=> 200,
                'atributKriteria'=> $atributKriteria
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

    public function update(Request $request, $id)
    {
        // membuat custom message untuk setiap validasi dari request yang dikirimkan user
        $messages = [
            'atribut_kriteria.required' => 'Atribut kriteria harus diisi'
        ];
        //untuk memvalidasi input yang dikirimkan oleh user
        $validator = Validator::make($request->all(),[
            'atribut_kriteria'=>'required'
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
            $model = AtributKriteria::find ($id);
            if($model){
                $model->atribut_kriteria = $request->atribut_kriteria;
                $model->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Data updated successfully',
                ]);
            } else {
                return response()->json([
                    'status'=>400,
                    'message'=>'Atribut kriteria not found',
                ]);
            }
        }
    }

}
