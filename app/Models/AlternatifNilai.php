<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class AlternatifNilai extends Model
{
    // use SoftDeletes;

    protected $table = 'alternatif_nilais';
    protected $guarded = array('id');
    
}
