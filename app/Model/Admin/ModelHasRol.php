<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ModelHasRol extends Model
{
    protected $table = "model_has_roles";

   public function rol(){
		return $this->belongsTo('App\ModelHasRol');
	}
}
