<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CdpsRegistroValor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cdps_registro_valor';

    public function registro(){
        return $this->hasOne('App\Model\Administrativo\Registro\Registro','id','registro_id');
    }

    public function cdpsRegistro(){
        return $this->hasOne('App\Model\Administrativo\Registro\RubrosCdp','id','rubrosCdp_id');
    }

    public function cdps(){
        return $this->hasOne('App\Model\Administrativo\Cdp\Cdp','id','cdp_id');
    }

    public function fontRubro(){
        return $this->belongsTo('App\Model\Hacienda\Presupuesto\FontsRubro','fontsRubro_id','id');
    }
}
