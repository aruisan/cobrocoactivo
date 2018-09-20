<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;

class Pdd extends Model
{
    protected $table = 'pdds';

    public function fonts(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Font','pdd_id');
	}

	public function ejes(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Eje','pdd_id');
	}

	public function dependencias(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Dependencia','pdd_id');
	}

}
