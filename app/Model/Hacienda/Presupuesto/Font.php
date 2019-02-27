<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Font extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	 public function fontsRubro(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\FontsRubro','font_id');
	}
}
