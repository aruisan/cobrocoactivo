<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{

    protected $fillable = ['name'];

    public function subProyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\SubProyecto','dependencia_id');
	}

	public function users(){
		return $this->hasMany('App\User','dependencia_id');
	}

    public function cdps(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\Cdp\Cdp','dependencia_id');
    }

}
