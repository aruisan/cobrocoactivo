<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Level extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function Registers(){
		return $this->hasMany('Register','id');
	}
}
