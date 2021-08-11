<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\AlternatifNilai;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use PDF;

class PerhitunganController extends Controller
{
    public function index() {
        $kriterias = Kriteria::orderBy('id','ASC')->get();

        $alternatif_nilais = AlternatifNilai::select([
            'alternatifs.id as kode_alternatif',
            'alternatifs.alternatif_nama as nama_alternatif',
            'alternatifs.alternatif_image as image_alternatif',
            'alternatif_nilais.kriteria_id as kode_kriteria',
            'alternatif_nilais.nilai_kriteria_id as kode_nilai_kriteria'
        ])
        ->join('alternatifs', 'alternatifs.id','=','alternatif_nilais.alternatif_id')
        ->join('kriterias', 'kriterias.id','=','alternatif_nilais.kriteria_id')
        ->orderBy('alternatifs.id','ASC')
        ->orderBy('alternatif_nilais.kriteria_id','ASC')
        ->groupBy('alternatif_nilais.alternatif_id')
        ->get();


        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $kode_krit = [];
        foreach ($kriteria as $krit)
        {
            $kode_krit[$krit->id] = [];
            foreach ($alternatif as $al)
            {
                foreach ($al->crip as $crip)
                {
                        if ($crip->kriteria->id == $krit->id)
                        {
                            $kode_krit[$krit->id][] = $crip->kn_nilai;
                        }
                }
            }

            if ($krit->kriteria_atribut == 'cost')
            {
                $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
            } elseif ($krit->kriteria_atribut == 'benefit')
            {
                $kode_krit[$krit->id] = max($kode_krit[$krit->id]);
            }
        };

        return view('admin.perhitungan.index', 
        compact('kriterias','alternatif_nilais','kriteria','alternatif','kode_krit'));
    }

    public function pdf()
    {

        $kriterias = Kriteria::orderBy('id','ASC')->get();

        $alternatif_nilais = AlternatifNilai::select([
            'alternatifs.id as kode_alternatif',
            'alternatifs.alternatif_nama as nama_alternatif',
            'alternatifs.alternatif_image as image_alternatif',
            'alternatif_nilais.kriteria_id as kode_kriteria',
            'alternatif_nilais.nilai_kriteria_id as kode_nilai_kriteria'
        ])
        ->join('alternatifs', 'alternatifs.id','=','alternatif_nilais.alternatif_id')
        ->join('kriterias', 'kriterias.id','=','alternatif_nilais.kriteria_id')
        ->orderBy('alternatifs.id','ASC')
        ->orderBy('alternatif_nilais.kriteria_id','ASC')
        ->groupBy('alternatif_nilais.alternatif_id')
        ->get();


        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $kode_krit = [];
        foreach ($kriteria as $krit)
        {
            $kode_krit[$krit->id] = [];
            foreach ($alternatif as $al)
            {
                foreach ($al->crip as $crip)
                {
                        if ($crip->kriteria->id == $krit->id)
                        {
                            $kode_krit[$krit->id][] = $crip->kn_nilai;
                        }
                }
            }

            if ($krit->kriteria_atribut == 'cost')
            {
                $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
            } elseif ($krit->kriteria_atribut == 'benefit')
            {
                $kode_krit[$krit->id] = max($kode_krit[$krit->id]);
            }
        };
      
        $pdf = PDF::loadView('admin.perhitungan.pdf', compact('kriterias','alternatif_nilais','kriteria','alternatif','kode_krit'))->setPaper('a4', 'potrait');

       
        return $pdf->stream();
    }
}
