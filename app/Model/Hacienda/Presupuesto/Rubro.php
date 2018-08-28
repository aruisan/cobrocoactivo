<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    public function dependencia(){
		return $this->hasOne('App\Model\Hacienda\Presupuesto\Dependencia','id', 'dependencia_id');
	}

	public function vigencia(){
		return $this->belongsTo('App\Model\Hacienda\Presupuesto\Vigencia', 'vigencia_id');
	}

	public function register() {
	  return $this->hasOne('App\Model\Hacienda\Presupuesto\Register', 'id', 'register_id');
	  //va la clase que lo relaciona el id de la tabla y la llave foranea
	}

	 public function fontsRubro(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\FontsRubro','rubro_id');
	}
}
