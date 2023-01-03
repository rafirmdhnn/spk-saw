<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotGejala extends Model
{
    protected $table = 'bobot_gejala';

    public function Kriteria(){
        return $this->hasMany('\App\Models\NewKriteria');
    }

    public function alternatif(){
        return $this->belongsTo('\App\Models\Alternatif','alternatif_id','id');
    }
}
