<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewKriteriaNilai extends Model
{
    protected $table = 'kriteria_nilai';

    public function Alternatif_Nilai(){
        return $this->hasMany('\App\Models\NewAlternatifNilai');
    }

    public function kriteria() {
        return $this->belongsTo('\App\Models\NewKriteria','kriteria_id','id');
    }
}
