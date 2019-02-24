<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Modulo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function permisos()
    {
        return $this->hasMany('Spatie\Permission\Models\Permission', 'modulo_id');
    }
}
