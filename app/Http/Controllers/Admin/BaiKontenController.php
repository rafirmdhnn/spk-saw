<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LevelBAI;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class BaiKontenController extends Controller
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
            $models = LevelBAI::get();

            // ini berfungsi untuk menampilkan data bobot preferensi ke dalam datatables
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models){
                // Fungsi ini adalah button ubah bobot preferensi
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<button type="button" value="'.$models->code_bai.'" class="edit_konten_bai btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_konten_bai"><span><i class="fa fa-pencil-alt"></i></span> Edit</button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.kontenbai.index');
    }

    public function edit($id)
    {
        // Untuk mendapatkan data kriteria sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $kontenBai = LevelBAI::where('code_bai', $id)->first();

        if($kontenBai)
        {
            return response()->json([
                'status'=> 200,
                'kontenBai'=> $kontenBai
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Konten BAI Not Found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
            // membuat custom message untuk setiap validasi dari request yang dikirimkan user
            $messages = [
                'level_bai.required' => 'Level BAI harus diisi',
                'detail_bai.required' => 'Detail BAI harus diisi',
            ];
            //untuk memvalidasi input yang dikirimkan oleh user
            $validator = Validator::make($request->all(),[
                'level_bai'=>'required',
                'detail_bai'=>'required'
            ], $messages);
    
            // if data validate is false then send response 400 with error message
            if($validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            // if data validate is true then run the query to update the data kriteria
            }else{
                $model = LevelBAI::find($id);
                if($model){
                    $model->level_bai = $request->level_bai;
                    $model->detail_bai = $request->detail_bai;
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
