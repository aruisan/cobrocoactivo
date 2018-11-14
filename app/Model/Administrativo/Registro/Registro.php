<?php

namespace App\Model\Administrativo\Registro;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
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
}
