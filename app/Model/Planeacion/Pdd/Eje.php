<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;

class Eje extends Model
{
    public function programas(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Programa', 'eje_id');
	}

	public function pdd(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Pdd');
	}
}
