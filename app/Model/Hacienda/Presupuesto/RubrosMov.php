<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;

class RubrosMov extends Model
{
    protected $table = 'rubros_mov';

    public function Resource(){
        return $this->belongsTo('App\Resource','resource_id');
    }

}
