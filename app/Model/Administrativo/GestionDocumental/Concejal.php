<?php

namespace App\Model\Administrativo\GestionDocumental;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Concejal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'concejales';

    public function persona(){
        return $this->belongsTo('App\Model\Persona', 'dato_id');
    }
}
