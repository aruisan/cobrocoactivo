<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class RubrosCdpValor extends Model
{
    protected $table = 'rubros_cdp_valor';

    public function rubrosCdp(){
        return $this->hasOne('App\Model\Administrativo\Cdp\RubrosCdp','id','rubrosCdp_id');
    }

}
