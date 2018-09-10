<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class FontsRubro extends Model
{
	protected $table = 'fonts_rubro';
	
    public function font(){
		return $this->hasOne('App\Model\Hacienda\Presupuesto\Font','id','font_id');
	}
}
