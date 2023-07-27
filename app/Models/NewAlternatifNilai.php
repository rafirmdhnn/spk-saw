<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewAlternatifNilai extends Model
{
    protected $table = 'alternatif_nilai';

    public function kriteria() {
        return $this->belongsTo('\App\Models\NewKriteria');
    }

    public function user() {
        return $this->belongsTo('\App\Models\NewUser');
    }

    public function kriteriaNilai() {
        return $this->belongsTo('\App\Models\NewKriteriaNilai');
    }
}
