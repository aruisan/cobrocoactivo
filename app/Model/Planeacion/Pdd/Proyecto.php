<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public function subProyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\SubProyecto','proyecto_id');
	}

	public function programa(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Programa');
	}
}
