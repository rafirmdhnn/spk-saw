<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekspedisi extends Model
{
    use SoftDeletes;

    protected $table = 'ekspedisis';
    protected $guarded = array('id');


    public function gudang() {
        return $this->hasMany('\App\Models\Gudang','ekspedisi_id','id');
    }
}
