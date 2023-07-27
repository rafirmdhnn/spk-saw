<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributKriteria extends Model
{
    protected $table = 'atribut_kriteria';

    public function Kriteria(){
        return $this->hasMany('\App\Models\NewKriteria');
    }
}
