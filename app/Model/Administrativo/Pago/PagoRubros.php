<?php

namespace App\Model\Administrativo\Pago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PagoRubros extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function rubro(){
        return $this->belongsTo('App\Model\Hacienda\Presupuesto\Rubro','rubro_id');
    }

    public function pago(){
        return $this->belongsTo('App\Model\Administrativo\Pago\Pagos','pago_id');
    }

}
