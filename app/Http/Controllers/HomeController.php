<?php

namespace App\Http\Controllers;

use App\Models\NewAlternatifNilai;
use Illuminate\Http\Request;
use App\Models\Surat;
use DB;
use App\Models\NewUser;
use App\Models\NilaiSaw;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_user = NewUser::count();

        $alternatif_nilai = NilaiSaw::select('saw_a1', 'saw_a2', 'saw_a3', 'saw_a4')->get()->toArray();

        $count_a1 = 0;
        $count_a2 = 0;
        $count_a3 = 0;
        $count_a4 = 0;
        foreach ($alternatif_nilai as $an) {
            $max_saw = array_keys($an, max($an));
            if($max_saw[0] === "saw_a1"){
                $count_a1 += 1;
            }elseif($max_saw[0] === "saw_a2"){
                $count_a2 += 1;
            }elseif($max_saw[0] === "saw_a3"){
                $count_a3 += 1;
            }elseif($max_saw[0] === "saw_a4"){
                $count_a4 += 1;
            };
        }
        // dd($alternatif_nilai);
        return view('home', [
            'count_user' => $count_user,
            'count_subjective' => $count_a1,
            'count_neurophysiology' => $count_a2,
            'count_autonomic' => $count_a3,
            'count_panic' => $count_a4
        ]);
    }
}
