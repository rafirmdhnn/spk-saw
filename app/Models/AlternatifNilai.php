<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class AlternatifNilai extends Model
{
    // use SoftDeletes;

    protected $table = 'alternatif_nilais';
    protected $guarded = array('id');
    
    public function kriteria() {
        return $this->belongsTo('\App\Models\Kriteria','kriteria_id','id');
    }

    public function user() {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }

    public function kriteriaNilai() {
        return $this->belongsTo('\App\Models\KriteriaNilai','nilai_kriteria_id','id');
    }
}
