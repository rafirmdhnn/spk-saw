<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelBAI extends Model
{
    protected $table = 'level_hasil_bai';
    protected  $primaryKey = 'code_bai';
    public $incrementing = false;

    public function score_bai(){
        return $this->hasMany('App\Models\ScoreBAI');
    }
}
