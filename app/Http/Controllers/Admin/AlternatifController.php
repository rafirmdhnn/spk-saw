<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
// use Symfony\Component\DomCrawler\Crawler;

class AlternatifController extends Controller
{
    protected $user_id;
    protected $user_role;
    private $results = array();

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!\Auth::check()) {
                return redirect('/login');
            }

            // you can access user id here
            $this->user_id = Auth::User()->id;
     
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
                // Fungsi ini menampilkan data alternatif berdasarkan waktu terbaru
                $models = Alternatif::orderBy('created_at', 'ASC')->get();
            
                // ini berfungsi untuk menampilkan data alternatif ke dalam datatables melalui ajax jquery
                return datatables()->of($models)
                ->addIndexColumn()
                ->addColumn('action', function ($models) {
                    // Fungsi ini adalah button ubah dan hapus alternatif
                    $button = '<div class="d-flex">';
                    $button .= '<div class="mr-1">';
                    $button .= '<button type="button" value="'.$models->id.'" class="edit_alternatif btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_alternatif"><span><i class="fa fa-pencil-alt"></i></span> Edit</button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])    
                ->make(true);
            }

            // untuk memanggil file index alternatif yang ada di dalam folder resources/view/admin/alternatif/index

            return view('admin.alternatif.index');
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     // untuk memanggil file create alternatif yang ada di dalam folder resources/view/admin/alternatif/create
    //     return view('admin.alternatif.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Untuk mendapatkan data alternatif sesuai parameter id nya, karena ini akan menampilkan data yang ingin di edit
        $alternatif = Alternatif::where('id', $id)->first();

        if($alternatif)
        {
            return response()->json([
                'status' => 200,
                'alternatif' => $alternatif
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Alternatif Not Found'
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
            'alternatif_kode.required' => 'Kode alternatif harus diisi',
            'alternatif_nama.required' => 'Nama alternatif harus diisi'
        ];
        //untuk memvalidasi input yang dikirimkan oleh user
        $validator = Validator::make($request->all(),[
            'alternatif_kode'=>'required',
            'alternatif_nama'=>'required'
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
            $model = Alternatif::find ($id);
            if($model){
                $model->alternatif_kode = $request->alternatif_kode;
                $model->alternatif_nama = $request->alternatif_nama;
                $model->update();

                return response()->json([
                    'status'=>200,
                    'message'=>'Data updated successfully',
                ]);
            } else {
                return response()->json([
                    'status'=>400,
                    'message'=>'Alternatif not found',
                ]);
            }
        }
    }
}
