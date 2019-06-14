<?php

namespace App\Model\Administrativo\OrdenPago\DescMunicipales;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DescMunicipales extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function orden_descuento(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosDescuentos');
    }
}
