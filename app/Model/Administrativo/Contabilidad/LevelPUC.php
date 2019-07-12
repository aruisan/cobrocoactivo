<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LevelPUC extends Model implements Auditable
{
    protected $table = 'level_pucs';

    use \OwenIt\Auditing\Auditable;

    public function Registers(){
        return $this->hasMany('App\Model\Administrativo\Contabilidad\RegistersPuc','id');
    }

}
