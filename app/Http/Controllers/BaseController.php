<?php

namespace App\Http\Controllers;

use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use App\Models\KriteriaNilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function index() {
        return view('user.home');
    }


    public function question() {
        $questions = Kriteria::with('kriteria_nilai')->get();

        return view('user.question', compact('questions'));
    }

    public function questionStore(Request $request) {
        $request->validate([
            'name'   => 'required',
            'umur'   => 'required',
            'email'  => 'required|email|unique:users,email'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->umur = $request->umur;
        $user->email = $request->email;
        $user->save();

        $nilai = $request->all();

        $total = 0;
        for ($i = 0; $i < count($request->questions); $i++) {
            $total += $request->nilai[$i];
            $id = $user->id;
            $answers[] = [
                'user_id' => $user->id,
                'kriteria_id' => $request->questions[$i],
                'nilai_kriteria_id' => $request->answers[$i+1]
            ];
        }
    
        AlternatifNilai::insert($answers);

        return redirect()->route('result', $id)
        ->with('success','Result successfully');
    }


    public function result($id) {
        $user_id = $id;
        
        $score = AlternatifNilai::with(['user','kriteriaNilai'])->where('user_id',$user_id)->get();
        return view('user.result', ['score' => $score, 'user_id' => $user_id]);
    }

    public function detail($id){
        $user = $id;

        $an = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)->get();
        // $alternatif1 = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)
        // ->whereHas('kriteria', function ($query){
        //     $query->where('alternatif_id','1');
        // })->get();
        // $alternatif2 = AlternatifNilai::with(['user','kriteriaNilai','kriteria'])->where('user_id',$user)
        // ->whereHas('kriteria', function ($query){
        //     $query->where('alternatif_id','2');
        // })->get();
        // $param = array(
        //     "an" => $an,
        //     "alternatif1" => $alternatif1,
        //     "alternatif2" => $alternatif2
        // );
        
    	 return view('user.saw', ['an' => $an]);
    }
}
