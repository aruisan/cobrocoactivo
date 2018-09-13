<?php

namespace App\Model\Administrativo;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    public function persona()
    {
        return $this->hasOne('App\Model\Persona');
    }

    public function cdp()
    {
        return $this->belongsTo('App\Model\Administrativo\Cdp\Cdp','cdp_id');
    }
}
