<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'nombre', 
    ];


    public function users()
    {
        return $this->hasMany('App\User');
    }
}
