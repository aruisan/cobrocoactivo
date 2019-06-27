<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RegistersPuc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function level()
    {
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\LevelPUC','level_puc_id');
    }

    public function rubro()
    {
        return $this->belongsTo('App\Model\Administrativo\Contabilidad\RubrosPuc', 'id');
    }

    public function code_padre()
    {
        return $this->hasOne('App\Model\Administrativo\Contabilidad\CodePadrePuc');
    }

    public function codes()
    {
        return $this->hasMany('App\Model\Administrativo\Contabilidad\CodePadrePuc', 'register2_puc_id');
    }
}
