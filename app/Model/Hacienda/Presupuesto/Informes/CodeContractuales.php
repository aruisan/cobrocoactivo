<?php

namespace App\Model\Hacienda\Presupuesto\Informes;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CodeContractuales extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public function rubro(){

        return $this->belongsTo('App\Model\Hacienda\Presupuesto\Rubro','id');

    }
}
