<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class PersonaPredio extends Model
{
    protected $table = "persona_predio";

    protected $fillable = [
    	'persona_id', 'predio_id', 'porcentaje',   
    ];

    public function personas(){

        return $this->belongsToMany('App\Model\Cobro\Persona');
    }

    public function predios(){

        return $this->belongsToMany('App\Model\Cobro\Predio');
    } 
}