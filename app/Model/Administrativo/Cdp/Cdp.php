<?php

namespace App\Model\Administrativo\Cdp;

use Illuminate\Database\Eloquent\Model;

class Cdp extends Model
{
    public function dependencia(){
        return $this->belongsTo('App\Model\Admin\Dependencia');
    }

    public function registros(){
        return $this->hasMany('App\Model\Administrativo\Registro','cdp_id');
    }

    public function rubrosCdp(){
        return $this->hasMany('App\Model\Administrativo\Cdp\RubrosCdp','cdp_id');
    }
}
