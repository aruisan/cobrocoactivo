<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;

class CdpsRegistro extends Model
{
    protected $table = 'cdps_registro';

    public function registro(){
        return $this->hasOne('App\Model\Administrativo\Registro\Registro','id','registro_id');
    }

    public function cdp(){
        return $this->hasOne('App\Model\Administrativo\Cdp\Cdp','id','cdp_id');
    }
}
