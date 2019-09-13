<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosRubros extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function cdps_registro(){
        return $this->hasMany('App\Model\Administrativo\Registro\CdpsRegistroValor');
    }

    public function orden_pago(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagos');
    }
}
