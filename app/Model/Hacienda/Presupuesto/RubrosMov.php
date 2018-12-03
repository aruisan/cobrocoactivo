<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class RubrosMov extends Model
{
    protected $table = 'rubros_mov';

    public function fontsRubro(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\FontsRubro','id','fonts_rubro_id');
    }

    public function rubro()
    {
        return $this->belongsTo('App\Model\Hacienda\Presupuesto\Rubro', 'id', 'rubro_id');
    }
}
