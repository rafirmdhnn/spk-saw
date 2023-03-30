<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiGejala extends Model
{
    protected $table = 'nilai_gejala';
    

    public function kriteria () {
        return $this->belongsToMany('\App\Models\NewKriteria', 'kriteria_nilai', 'kn_gejala_id', 'kriteria_id');
    }
}
