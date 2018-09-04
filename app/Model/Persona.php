<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
    	'nombre', 'num_dc', 'email', 'direccion', 'tipo', 'telefono', 
    ];

     public function predios(){
        return $this->belongsToMany('App\Model\Cobro\Predio');
    }
}
