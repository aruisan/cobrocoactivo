<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
	 public function fontsRubro(){
		return $this->hasMany('App\FontsRubro','font_id');
	}
}
