<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FontsRubro extends Model
{
	protected $table = 'fonts_rubro';
	
    public function font(){
		return $this->hasMany('App\Font','font_id');
	}
}
