<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;

class CdpsRegistroValor extends Model
{
    protected $table = 'cdps_registro_valor';

    //fixed this
    public function cdpsRegistro(){
        return $this->hasOne('App\Model\Administrativo\Registro\CdpsRegistro','id','cdps_registro_id');
    }

    public function rubrosCdpValor(){
        return $this->hasOne('App\Model\Administrativo\Cdp\RubrosCdpValor','id','rubros_cdp_valor_id');
    }

    public function registro(){
        return $this->hasOne('App\Model\Administrativo\Registro\Registro','id','registro_id');
    }
}
