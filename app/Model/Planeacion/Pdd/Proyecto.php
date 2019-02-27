<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Proyecto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function subProyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\SubProyecto','proyecto_id');
	}

	public function programa(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Programa');
	}
}
