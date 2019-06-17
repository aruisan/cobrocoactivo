<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosDescuentos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function descuento_retencion(){
        return $this->belongsTo('App\Model\Administrativo\OrdenPago\RetencionFuente\RetencionFuente','retencion_fuente_id');
    }

    public function descuento_mun(){
        return $this->belongsTo('App\Model\Administrativo\OrdenPago\DescMunicipales\DescMunicipales','desc_municipal_id');
    }
}
