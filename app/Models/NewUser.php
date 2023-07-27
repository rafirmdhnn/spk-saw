<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    protected $table = 'user';
    protected $guarded = array('id');

    public function alternatif_nilai(){
        return $this->hasOne('\App\Models\NewAlternatif');
    }

    public function score_bai(){
        return $this->hasOne('\App\Models\ScoreBAI');
    }

    public function matriks_prenorm(){
        return $this->hasOne('\App\Models\MatriksPreNorm');
    }
    
    public function matriks_postnorm(){
        return $this->hasOne('\App\Models\MatriksPostNorm');
    }

    public function hasil_saw(){
        return $this->hasOne('\App\Models\NilaiSaw');
    }

}
