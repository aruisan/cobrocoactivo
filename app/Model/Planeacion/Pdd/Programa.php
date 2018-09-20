<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public function proyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Proyecto', 'programa_id');
	}

	public function eje(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Eje');
	}
}
