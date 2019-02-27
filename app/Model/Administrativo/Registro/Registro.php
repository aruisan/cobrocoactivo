<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Registro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function persona()
    {
        return $this->hasOne('App\Model\Persona','id','persona_id');
    }

    public function contrato()
    {
        return $this->hasOne('App\Model\Administrativo\Contractuall\Contractual','id','contrato_id');
    }

    public function cdpsRegistro(){
        return $this->hasMany('App\Model\Administrativo\Registro\CdpsRegistro','registro_id');
    }

    public function ordenPagos(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagos','registros_id');
    }

}
