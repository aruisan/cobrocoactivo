<?php

namespace App\Model\Administrativo\Pago;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PagoRubros extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

}
