<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Modulo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];


    public function permisos()
    {
        return $this->hasMany('Spatie\Permission\Models\Permission', 'modulo_id');
    }
    public function TabsPermission()
    {
        return $this->hasMany('Spatie\TabsPermission\TabsPermission', 'tabs_permission_id');
    }
}
