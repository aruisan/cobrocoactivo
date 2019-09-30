<?php

namespace App\Model\Administrativo\Pago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pagos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function orden_pago(){
        return $this->belongsTo('App\Model\Administrativo\OrdenPago\OrdenPagos');
    }

    public function banks(){
        return $this->hasMany('App\Model\Administrativo\Pago\PagoBanks');
    }
}
