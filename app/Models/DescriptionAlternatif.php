<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescriptionAlternatif extends Model
{
    use SoftDeletes;

    protected $table = 'desc_alternatif';
    protected $guarded = array('id');
    
}
