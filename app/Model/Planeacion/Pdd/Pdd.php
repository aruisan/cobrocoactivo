<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pdd extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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
