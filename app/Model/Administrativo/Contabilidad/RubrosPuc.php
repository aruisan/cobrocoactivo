<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class RubrosPuc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public function vigencia(){
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\Puc', 'puc_id');
    }

    public function register() {
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\RegistersPuc','registers_puc_id');
    }

    public function persona(){
        return $this->belongsTo('App\Model\Persona','persona_id');
    }

    public function op_puc(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagos');
    }

    public function payments(){
        return $this->hasMany('App\Model\Administrativo\OrdenPago\OrdenPagosPayments');
    }

}
