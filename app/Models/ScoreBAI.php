<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreBAI extends Model
{
    protected $table = 'score_bai';

    public function level_bai(){
        return $this->belongsTo('App\Models\LevelBAI');
    }

    public function user(){
        return $this->belongsTo('App\Models\NewUser');
    }
}
?>