<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    
    public function Registers(){
		return $this->hasMany('Register','id');
	}
}
