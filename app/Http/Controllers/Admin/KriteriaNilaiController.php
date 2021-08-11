<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\KriteriaNilai;
use Illuminate\Http\Request;
use Auth;

class KriteriaNilaiController extends Controller
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
    public function index(Request $request)
    {
        $user_id = $this->user_id;
        // ini untuk mengambil $_GET kriteria_id atau digunakan untuk memfilter kriteria
        $kriteria_id = $request->get('kriteria_id');
        
        // menampilkan data nilai kriteria berdasarkan kriteria_id teratas ASC dan nilai tertinggi DESC
        $nilais = KriteriaNilai::with(['kriteria' => function($q) {
            $q->orderBy('kriteria_nama','ASC');
        }])->orderBy('kriteria_id','ASC');

        // jika $kriteria_id sudah di filter akan menampilkan data where kriteria_id
        if(!empty($kriteria_id)) {
            $nilais = $nilais->where('kriteria_id', $kriteria_id);
        }

        // menampilkan data nilai kriteria berdasarkan nilai tertinggi
        $nilais = $nilais->orderBy('kn_nilai','DESC')->get();


        // menampilkan data kriteria berdasarkan nama teratas
        $kriterias = Kriteria::orderBy('id','ASC')->get();
        
         // untuk memanggil file index nilai kriteria yang ada di dalam folder resources/view/admin/kriterianilai/index
         // compact berfungsi untuk mengirim nilai data ke view kriterianilai 
        return view('admin.kriterianilai.index', compact('nilais','kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // menampilkan data kriteria di select option kriteria pada saat tambah kriteria nilai
        $kriterias = Kriteria::select('id','kriteria_nama')->orderBy('id','ASC')->get();
        // untuk memanggil file create nilai kriteria yang ada di dalam folder resources/view/admin/kriterianilai/create
        return view('admin.kriterianilai.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fungsi untuk validasi jika kriteria_id, keterangan dan nilai kriteria kosong, jadi harus requried saat insert data
        $request->validate([
            'kriteria_id'   => 'required',
            'kn_keterangan' => 'required',
            'kn_nilai' => 'required'
        ]);
        // deklarasi nilai user_id dari construct
        // $user_id = $this->user_id;
        
        // alur tambah data menggunakan eloquent, eloquent adalah model dari laravel
        // memanggil kriteria nilai menggunakan new KriteriaNilai
        $model = new KriteriaNilai;
         // memanggil $_POST name kriteria_id
        $model->kriteria_id  = $request->kriteria_id;
         // memanggil $_POST name kn_keterangan
        $model->kn_keterangan = $request->kn_keterangan;
        // memanggil $_POST name kn_nilai
        $model->kn_nilai = $request->kn_nilai;
        // memanggil user_id dari auth user sehingga mendapatkan user_id user
        // $model->user_id = $user_id;
        // karena yg di insert atau tambah 3 field saja, maka sistem akan mengsave atau simpan
        $model->save();
        
        // Jika berhasil tambah data nilai kriteria, akan redirect ke halaman kriteria-nilai.index,
        // dan menampilkan pesan berhasil Nilai Kriteria  created successfully
        return redirect()->route('kriteria-nilai.index')
                        ->with('success','Nilai Kriteria created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // menampilkan data kriteria di select option kriteria pada saat tambah kriteria nilai
        $kriterias = Kriteria::select('id','kriteria_nama')->orderBy('kriteria_nama','ASC')->get();
        // Untuk mendapatkan data nilai kriteria sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $kriterianilai = KriteriaNilai::findOrFail($id);
        // untuk memanggil file edit nilai kriteria yang ada di dalam folder resources/view/admin/kriterianilai/edit
        // compact artinya fungsi untuk memparsing nilai / data ke file view kriterianilai.edit
        return view('admin.kriterianilai.edit', compact('kriterias','kriterianilai'));
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
        // fungsi untuk validasi jika kriteria_id, kn_keterangan dan kn_nilai nilai kriteria kosong, jadi harus requried saat ubah data
        $request->validate([
            'kriteria_id'   => 'required',
            'kn_keterangan' => 'required',
            'kn_nilai' => 'required'
        ]);
        $request->validate([
            'kn_nilai' => 'required'
        ]);   
        $model = KriteriaNilai::find($id);     
        // cara kerja code ini sama dengan insert data, tapi ini khusus untuk edit data
        // karena ada findOrFail artinya edit data berdasarkan $id 
        $model->kriteria_id  = $request->kriteria_id;
        $model->kn_keterangan = $request->kn_keterangan;
        $model->kn_nilai = $request->kn_nilai;
        $model->save();

        // Jika berhasil ubah/edit data user , akan redirect ke halaman kriteria-nilai.edit,
        // dan menampilkan pesan berhasil Nilai Kriteria has been updated

        $request->session()->flash('message', 'Successfully modified the task!');
        return redirect()->route('kriteria-nilai.index', $id)->with('success', 'Nilai Kriteria has been updated');
        // return redirect()->route('kriteria-nilai.edit', $id)->with('success', 'Nilai Kriteria has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
