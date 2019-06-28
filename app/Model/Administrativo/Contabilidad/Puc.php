<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Puc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function rubros(){
        return $this->hasMany('App\Model\Administrativo\Contabilidad\RubrosPuc','puc_id');
    }


    public function levels(){
        return $this->hasMany('App\Model\Administrativo\Contabilidad\LevelPUC','puc_id');
    }

}
