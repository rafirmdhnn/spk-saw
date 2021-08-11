<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Auth;

class KriteriaController extends Controller
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
            $models = Kriteria::with('alternatif')->orderBy('id', 'ASC')->get();
           
            // ini berfungsi untuk menampilkan data kriteria ke dalam datatables melalui ajax jquery
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models) {
                // Fungsi ini adalah button ubah dan hapus kriteria
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('kriteria.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                $button .= '</div>';
                // if($this->user_role == 1) {
                //     $button .= '<div>';
                //     $button .= '<form action="' . route('kriteria.destroy', $models->id) . '" method="POST">';
                //     $button .= '<input type="hidden" name="_method" value="delete" />';
                //     $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                //     $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                //     $button .= '</form>';
                //     $button .= '</div>';
                // }
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action','is_role'])    
            ->make(true);
        }

         // untuk memanggil file index kriteria yang ada di dalam folder resources/view/admin/kriteria/index
        return view('admin.kriteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // untuk memanggil file create kriteria yang ada di dalam folder resources/view/admin/kriteria/create
        return view('admin.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fungsi untuk validasi jika nama dan keterangan kriteria kosong, jadi harus requried saat insert data
        $request->validate([
            'kriteria_nama'   => 'required',
            'kriteria_atribut' => 'required',
            'kriteria_bobot' => 'required'
        ]);
  
        // alur tambah data menggunakan eloquent, eloquent adalah model dari laravel
        // memanggil kriteria menggunakan new kriteria
        $model = new Kriteria;
        // memanggil $_POST nama kriteria
        $model->kriteria_nama = $request->kriteria_nama;
        // memanggil $_POST atribut kriteria
        $model->kriteria_atribut = $request->kriteria_atribut;
         // memanggil $_POST bobot kriteria
        $model->kriteria_bobot = $request->kriteria_bobot;
        // memanggil user_id dari auth user sehingga mendapatkan user_id user

        // karena yg di insert atau tambah 3 field saja, maka sistem akan mengsave atau simpan
        $model->save();
  
        // Jika berhasil tambah data kriteria, akan redirect ke halaman kriteria.index,
        // dan menampilkan pesan berhasil Kriteria created successfully
        return redirect()->route('kriteria.index')
                        ->with('success','Kriteria created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $kriteria = Kriteria::findOrFail($id);
        // untuk memanggil file edit kriteria yang ada di dalam folder resources/view/admin/kriteria/edit
        // compact artinya fungsi untuk memparsing nilai / data ke file view kriteria.edit
        return view('admin.kriteria.edit', compact('kriteria'));
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
        if($this->user_id == 1) {
            // fungsi untuk validasi jika nama, atribut dan bobot alternatif kosong, jadi harus requried saat ubah data
            $request->validate([
                'kriteria_nama'   => 'required',
                'kriteria_atribut' => 'required',
                'kriteria_bobot' => 'required'
            ]);
        } else {
            // fungsi untuk validasi jika nama, atribut dan bobot alternatif kosong, jadi harus requried saat ubah data
            $request->validate([
                'kriteria_bobot' => 'required'
            ]);
        }
        
  
        // cara kerja code ini sama dengan insert data, tapi ini khusus untuk edit data
        // karena ada findOrFail artinya edit data berdasarkan $id 
        $model = Kriteria::findOrFail($id);
        if($this->user_id == 1) {
            $model->kriteria_nama = $request->kriteria_nama;
            $model->kriteria_atribut = $request->kriteria_atribut;
            $model->kriteria_bobot = $request->kriteria_bobot;
        } else {
            $model->kriteria_bobot = $request->kriteria_bobot;   
        }
        $model->save();
            
        // Jika berhasil ubah/edit data kriteria , akan redirect ke halaman kriteria.edit,
        // dan menampilkan pesan berhasil Kriteria has been updated
        $request->session()->flash('message', 'Successfully modified the task!');
        return redirect()->route('kriteria.index')->with('success', 'Kriteria has been updated');
        // return redirect()->route('kriteria.edit', $id)->with('success', 'Kriteria has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // ini fungsi untuk hapus data kriteria berdasarkan $id yang di hapus
        $models = Kriteria::find($id)->delete();

        // Jika berhasil dihapus data kriteria , akan redirect ke halaman kriteria.index,
        // lalu menampilkan pesan Kriteria berhasil di hapus
        return redirect()->route('kriteria.index')
                        ->with('success','Kriteria berhasil di hapus');
    }
}
