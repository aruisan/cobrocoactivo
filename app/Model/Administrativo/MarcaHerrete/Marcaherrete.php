<?php

namespace App\Model\Administrativo\MarcaHerrete;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Marcaherrete extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = "marca_herretes";


}
