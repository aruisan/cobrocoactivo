<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class FontsRubro extends Model
{
	protected $table = 'fonts_rubro';
	
    public function font(){
		return $this->hasMany('App\Model\Hacienda\Presupuesto\Font','font_id');
	}
}
