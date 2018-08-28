<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
     public function rubros(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\Rubro','vigencia_id');
	}

	public function fonts(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\Font','vigencia_id');
	}

	public function levels(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\Level','vigencia_id');
	}
}
