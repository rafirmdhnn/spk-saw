<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewKriteria extends Model
{
    protected $table = "kriteria";

    public function alternatif(){
        return $this->belongsTo('\App\Models\Alternatif','alternatif_id','id');
    }

    public function bobot_gejala(){
        return $this->belongsTo('\App\Models\BobotGejala','kriteria_bobot_id','id');
    }

    public function atribut_kriteria(){
        return $this->belongsTo('\App\Models\AtributKriteria', 'kriteria_atribut_id', 'id');
    }

    public function nilai_gejala(){
        return $this->belongsToMany('\App\Models\NilaiGejala', 'kriteria_nilai', 'kriteria_id', 'kn_gejala_id');
    }

    public function alternatif_nilai() {
        return $this->hasMany('\App\Models\NewAlternatifNilai');
    }

    public function kriteria_nilai() {
        return $this->hasMany('\App\Models\NewKriteriaNilai','kriteria_id','id');
    }
}
