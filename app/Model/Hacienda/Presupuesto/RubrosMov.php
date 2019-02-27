<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RubrosMov extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'rubros_mov';

    public function Resource(){
        return $this->belongsTo('App\Resource','resource_id');
    }

}
