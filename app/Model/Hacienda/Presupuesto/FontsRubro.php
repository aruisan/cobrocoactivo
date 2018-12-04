<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class FontsRubro extends Model
{
	protected $table = 'fonts_rubro';
	
    public function font(){
		return $this->hasOne('App\Model\Hacienda\Presupuesto\Font','id','font_id');
	}

    public function rubrosCdpValor(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdpValor','fontsRubro_id');
    }

    public function rubrosMov(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\RubrosMov','fonts_rubro_id');
    }
}
