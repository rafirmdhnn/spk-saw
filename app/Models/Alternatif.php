<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Alternatif extends Model
{
    // use SoftDeletes;

    protected $table = 'alternatifs';
    protected $guarded = array('id');

    public function crip()
    {
        return $this->belongsToMany(\App\Models\KriteriaNilai::class,'alternatif_nilais','alternatif_id','nilai_kriteria_id')->orderBy('kriteria_id', 'ASC');
    }

    public function Kriteria(){
        return $this->hasMany('\App\Models\NewKriteria');
    }
    
    public function Bobot(){
        return $this->hasMany('\App\Models\BobotGejala');
    }
}
