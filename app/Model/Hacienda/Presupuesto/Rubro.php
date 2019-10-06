<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Rubro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function dependencia(){
		return $this->hasOne('App\Model\Dependencia','id', 'dependencia_id');
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

    public function subProyecto() {
        return $this->hasOne('App\Model\Planeacion\Pdd\SubProyecto', 'id', 'subproyecto_id');
    }

    public function rubrosCdp(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdp','rubro_id');
    }

    public function cdpRegistroValor(){
        return $this->hasMany('App\Model\Administrativo\Registro\CdpsRegistroValor','rubro_id');
    }

    public function rubrosMov(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\RubrosMov','rubro_id');
    }

    public function pago(){
        return $this->hasMany('App\Model\Administrativo\Pago\PagoRubros','rubro_id');
    }
}
