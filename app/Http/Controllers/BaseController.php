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

        
        for ($i = 0; $i < count($request->questions); $i++) {
            // $kriteria = KriteriaNilai::where('kriteria_id', $request->answers[$i+1])->get();
   
         
            $answers[] = [
                'user_id' => $user->id,
                'kriteria_id' => $request->questions[$i],
                'nilai_kriteria_id' => $request->answers[$i+1]
            ];
        }

        AlternatifNilai::insert($answers);

        return redirect()->route('question')
        ->with('success','Nilai updated successfully');
    }

    public function daftar($nisn = null)
   {
    //  $this->validate($request, [
    //     'nisn' => 'required',
    //   ]);

    //   $countdown = Countdown::find(1);

    //   if (now()->isBefore($countdown->pendaftaran)) {
         $response = Http::withBasicAuth('puspresnas', 'Pu5pReSn4s123!@#')->get('https://pelayanan.data.kemdikbud.go.id/api/puspresnas/siswa?id='.$nisn.'');
         $data = $response->json();

         dd($data);
        //  if ($data) {
        //     $detail = Jenjang::find($request->jenjang);
        //     $datas = $data;
        //     if ($datas['tingkat_pendidikan'] < $detail->kelas_minimal) {
        //        return redirect()->route('register')->with('kelas',$datas['tingkat_pendidikan']);
        //     } else {
        //        $myString = $detail->jenjang;
        //        $myArray = explode(',', $myString);
        //        if (in_array($datas['bentuk_pendidikan'], $myArray)) {
        //           $sekolah = Http::withBasicAuth('puspresnas', 'Pu5pReSn4s123!@#')->post('https://pelayanan.data.kemdikbud.go.id/api/puspresnas/sekolah?id='.$datas['npsn'].'');
        //           $data_sekolah = $sekolah->json();
        //           $bidang = Bidang::where('status',1)->get();
        //           return view('frontend.daftar', compact('datas','detail','data_sekolah','bidang'));
        //        } else {
        //            return redirect()->route('register')->with('salah_jenjang',$datas['bentuk_pendidikan']);
        //        }
        //        // return $detail->jenjang[0];
        //     } 
        //  } else {
        //     return redirect()->route('register')->with('nisn_not_found','Maaf');
        //  }
    //   } else {
    //      $tutup = Carbon::parse($countdown->pendaftaran_pengunggahan)->format('d M Y h:i:s');
    //      return redirect('login')->with('waktu_habis',$tutup);
    //   }
   }


}
