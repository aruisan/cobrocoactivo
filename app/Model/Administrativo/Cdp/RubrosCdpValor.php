<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class RubrosCdpValor extends Model
{
    protected $table = 'rubros_cdp_valor';

    public function rubrosCdp(){
        return $this->hasOne('App\Model\Administrativo\Cdp\RubrosCdp','id','rubrosCdp_id');
    }

    public function fontsRubro(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\FontsRubro','id','fontsRubro_id');
    }

    public function cdps(){
        return $this->hasOne('App\Model\Administrativo\Cdp\Cdp','id','cdp_id');
    }

}
