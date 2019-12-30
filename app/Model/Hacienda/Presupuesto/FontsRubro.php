<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FontsRubro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'fonts_rubro';

    public function fontVigencia(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\FontsVigencia','id','font_vigencia_id');
    }
    public function rubrosCdpValor(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdpValor','fontsRubro_id');
    }
    public function cdpRegistrosValor(){
        return $this->hasMany('App\Model\Administrativo\Registro\CdpsRegistroValor','fontsRubro_id');
    }
    public function rubrosMov(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\RubrosMov','fonts_rubro_id');
    }
    public function rubro(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\Rubro','id','rubro_id');
    }
}
