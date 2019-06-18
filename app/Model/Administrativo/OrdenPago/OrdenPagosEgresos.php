<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosEgresos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function orden_pago_payments(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosPayments');
    }
}
