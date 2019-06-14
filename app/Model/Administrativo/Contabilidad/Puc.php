<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Puc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function persona(){
        return $this->belongsTo('App\Model\Persona','persona_id');
    }
}
