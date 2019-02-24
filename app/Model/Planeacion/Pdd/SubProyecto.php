<?php

namespace App\Model\Planeacion\Pdd;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SubProyecto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function periodos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\Periodo','subproyecto_id');
	}

	public function dependencia(){
		return $this->belongsTo('App\Model\Admin\Dependencia');
	}

	public function proyecto(){
		return $this->belongsTo('App\Model\Planeacion\Pdd\Proyecto');
	}
}
