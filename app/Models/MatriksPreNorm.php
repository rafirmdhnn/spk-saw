<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriksPreNorm extends Model
{
    protected $table = 'matriks_prenorm';

    public function user(){
        return $this->belongsTo('App\Models\NewUser');
    }
}
