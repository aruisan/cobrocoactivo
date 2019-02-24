<?php

namespace App\Model\Administrativo\OrdenPago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrdenPagosFechas extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
