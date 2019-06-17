<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function registros()
    {
        return $this->hasOne('App\Model\Administrativo\Registro\Registro','id','registros_id');
    }

    public function fechas(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosFechas','orden_pagos_id');
    }

    public function descuentos(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos','orden_pagos_id');
    }

    public function pucs(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosPuc','orden_pago_id');
    }
}
