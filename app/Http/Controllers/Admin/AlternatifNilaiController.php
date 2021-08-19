<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Libraries\Helpers;
use DB;
use Auth;

class AlternatifNilaiController extends Controller
{
    protected $user_id;
    protected $user_level;

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!\Auth::check()) {
                return redirect('/login');
            }

            // you can access user id here
            $this->user_id = Auth::User()->id;
            $this->user_level = Auth::User()->level; 
     
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
        // query eloquend database untuk menampilkan data kriteria
        $kriterias = Kriteria::orderBy('id','ASC')->get();
        
        // query eloquend database untuk menampilkan data hasil analisa
        $rows = AlternatifNilai::select([
                    'alternatifs.id as kode_alternatif',
                    'users.id as id',
                    'users.name as nama',
                    'users.umur',
                    'alternatifs.alternatif_nama as nama_alternatif',
                    'alternatif_nilais.kriteria_id as kode_kriteria',
                    'alternatif_nilais.nilai_kriteria_id as kode_nilai_kriteria'
                ])
                ->join('users', 'users.id','=','alternatif_nilais.user_id')
                ->join('kriterias', 'kriterias.id','=','alternatif_nilais.kriteria_id')
                ->join('alternatifs', 'alternatifs.id','=','kriterias.alternatif_id')
                ->orderBy('alternatifs.id','ASC')
                ->orderBy('alternatif_nilais.kriteria_id','ASC')
                ->groupBy('alternatif_nilais.user_id')
                ->get();
       
        // jika berhasil redirect ke yang ada di dalam folder resources/view/admin/alternatifnilai/index
        // compact untuk parsing data ke view   resources/view/admin/alternatifnilai/index
        return view('admin.alternatifnilai.index', compact('kriterias','rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // cek jika admin
        if($this->user_level == 1) {
            // query eloquend database untuk menampilkan data alternatif nilai berdsarakan id
            $alternatifnilai = AlternatifNilai::where('alternatif_id', $id)->first();
             // query eloquend database untuk menampilkan data alternatif nilai
            $selects = AlternatifNilai::select('alternatif_nilais.id', 'kriterias.id as kode_kriteria', 'kriterias.kriteria_nama', 
            'alternatif_nilais.nilai_kriteria_id')
            ->join('kriterias', 'kriterias.id', '=', 'alternatif_nilais.kriteria_id')
            ->where('alternatif_id', $id)
            ->orderBy('kriteria_id','ASC')->get();

            
            // jika berhasil redirect ke yang ada di dalam folder resources/view/admin/alternatifnilai/edit
        // compact untuk parsing data ke view   resources/view/admin/alternatifnilai/edit
            return view('admin.alternatifnilai.edit', compact('alternatifnilai','selects'));
        } else {
            echo "Anda tidak memiliki akses";
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
        
        foreach($_POST as $k => $v){
            $id_alternatif = str_replace('kriteria_name-', '', $k);
            $values = array(
                            'nilai_kriteria_id' => $v,
                        );
            DB::table('alternatif_nilais')->where('id','=',$id_alternatif)->update($values);
        }

        $request->session()->flash('message', 'Successfully modified the task!');
        return redirect()->route('alternatif-nilai.index')->with('success', 'Nilai Alternatif has been updated');
        // return redirect()->route('alternatif-nilai.edit', $id)->with('success', 'Nilai Alternatif has been updated');
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
