<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosPayments extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function data_puc(){
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\Puc','puc_id');
    }

    public function egreso(){
        return $this->belongsTo('App\Model\Administrativo\OrdenPago\OrdenPagosEgresos','orden_pago_egreso_id');
    }

}
