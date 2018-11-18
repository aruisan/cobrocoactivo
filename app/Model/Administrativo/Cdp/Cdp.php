<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class Cdp extends Model
{
    public function dependencia(){
        return $this->belongsTo('App\Model\Admin\Dependencia');
    }

    public function rubrosCdp(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdp','cdp_id');
    }

    public function rubrosCdpValor(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdpValor','cdp_id');
    }

    public function cdpsRegistro(){
        return $this->hasMany('App\Model\Administrativo\Registro\CdpsRegistro','cdp_id');
    }
}
