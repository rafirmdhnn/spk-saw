<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaNilai extends Model
{
    use SoftDeletes;

    protected $table = 'kriteria_nilais';
    protected $guarded = array('id');

    public function kriteria() {
        return $this->belongsTo('\App\Models\Kriteria','kriteria_id','id');
    }

    public function alternatif_nilai() {
        return $this->hasOne('\App\Models\AlternatifNilai');
    }

}
