<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSaw extends Model
{
    protected $table = 'hasil_saw';

    public function user(){
        return $this->belongsTo('App\Models\NewUser');
    }
}
