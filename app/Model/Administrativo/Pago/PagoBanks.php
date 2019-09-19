<?php

namespace App\Model\Administrativo\Pago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PagoBanks extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function data_puc(){
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\RubrosPuc','rubros_puc_id');
    }

    public function pago(){
        return $this->belongsToMany('App\Model\Administrativo\Pago\Pagos', 'pago_id');
    }

}
