<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class RubrosCdp extends Model
{
    protected $table = 'rubros_cdp';

    public function rubros(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\Rubro','id','rubro_id');
    }
}
