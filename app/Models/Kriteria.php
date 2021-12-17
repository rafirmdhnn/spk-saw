<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteria extends Model
{
    use SoftDeletes;

    protected $table = 'kriterias';
    protected $guarded = array('id');

    public function alternatif() {
        return $this->belongsTo('\App\Models\Alternatif','alternatif_id','id');
    }

    public function kriteria_nilai() {
        return $this->hasMany('\App\Models\KriteriaNilai','kriteria_id','id');
    }

    public function alternatif_nilai() {
        return $this->hasOne('\App\Models\AlternatifNilai');
    }
}
