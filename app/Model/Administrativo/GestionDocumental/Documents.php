<?php

namespace App\Model\Administrativo\GestionDocumental;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Documents extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'documents';

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function persona(){
        return $this->belongsTo('App\Model\Persona', 'persona_id');
    }

    public function resource()
    {
        return $this->belongsTo('App\Resource', 'resource_id');
    }

    public function comision()
    {
        return $this->belongsTo('App\Model\Administrativo\GestionDocumental\Comisiones','comision_id');
    }

    public function concejalesPonentes()
    {
        return $this->belongsTo('App\Model\Administrativo\GestionDocumental\Concejal','ponente_id');
    }

    public function Concejales()
    {
        return $this->belongsTo('App\Model\Administrativo\GestionDocumental\Concejal','concejal_id');
    }

    public function tercero(){
        return $this->belongsTo('App\Model\Persona', 'tercero_id');
    }
}
