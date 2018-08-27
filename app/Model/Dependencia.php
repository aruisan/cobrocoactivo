<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{

    protected $fillable = ['name'];

     public function subProyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\SubProyecto','dependencia_id');
	}

	public function pdd(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Pdd');
	}
}
