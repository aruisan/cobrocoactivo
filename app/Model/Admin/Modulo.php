<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    public function permisos()
    {
        return $this->hasMany('Spatie\Permission\Models\Permission', 'modulo_id');
    }
}
