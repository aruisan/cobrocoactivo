<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Eje extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function programas(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Programa', 'eje_id');
	}

	public function pdd(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Pdd');
	}
}
