<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
	 public function fontsRubro(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\FontsRubro','font_id');
	}
}
