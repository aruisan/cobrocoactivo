<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosRubros extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function cdps_registro(){
        return $this->belongsTo('App\Model\Administrativo\Registro\CdpsRegistroValor','cdps_registro_valor_id');
    }

    public function orden_pago(){
        return $this->belongsTo('App\Model\Administrativo\OrdenPago\OrdenPagos','orden_pagos_id');
    }
}
