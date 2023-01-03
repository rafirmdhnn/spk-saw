<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table = 'administrator';
    protected $guarded = array('id');

    protected $fillable = [
        'name', 'email'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
