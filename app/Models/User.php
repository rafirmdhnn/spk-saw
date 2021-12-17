<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');

    public function alternatif_nilai() {
        return $this->hasOne('\App\Models\User');
    }

}
