<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class RubrosCdp extends Model
{
    protected $table = 'rubros_cdp';

    public function rubrosCdp(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\Rubro','id','rubro_id');
    }
}
