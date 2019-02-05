<?php

namespace App\Model\Administrativo\GestionDocumental;

use Illuminate\Database\Eloquent\Model;

class Concejal extends Model
{
    protected $table = 'concejales';

    public function persona(){
        return $this->belongsTo('App\Model\Persona', 'dato_id');
    }
}
