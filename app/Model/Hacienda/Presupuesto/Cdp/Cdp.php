<?php

namespace App\Model\Hacienda\Presupuesto\Cdp;

use Illuminate\Database\Eloquent\Model;

class Cdp extends Model
{
    public function dependencia(){
        return $this->belongsTo('App\Model\Admin\Dependencia');
    }

    public function rubros(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\Rubro','rubro_id');
    }
}
