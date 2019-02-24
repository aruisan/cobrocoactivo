<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CdpsRegistro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cdps_registro';

    public function registro(){
        return $this->hasOne('App\Model\Administrativo\Registro\Registro','id','registro_id');
    }

    public function cdp(){
        return $this->hasOne('App\Model\Administrativo\Cdp\Cdp','id','cdp_id');
    }
}
