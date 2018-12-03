<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{

    public function level()
    {
		return $this->belongsTo('App\Model\Hacienda\Presupuesto\Level','level_id');
	}

	public function rubro()
	{
	  return $this->belongsTo('App\Model\Hacienda\Presupuesto\Rubro', 'id');
	}

	public function code_padre()
    {
        return $this->hasOne('App\Model\Hacienda\Presupuesto\CodePadre');
    }

    public function codes()
    {
        return $this->hasMany('App\Model\Hacienda\Presupuesto\CodePadre', 'register2_id');
    }
}
