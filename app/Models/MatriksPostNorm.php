<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriksPostNorm extends Model
{
    protected $table = 'matriks_postnorm';

    public function user(){
        return $this->belongsTo('App\Models\NewUser');
    }
}
