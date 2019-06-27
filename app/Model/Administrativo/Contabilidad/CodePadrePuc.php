<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CodePadrePuc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function register(){
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\RegistersPuc');
    }

    public function registers()
    {
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\RegistersPuc', 'register2_puc_id');
    }
}
