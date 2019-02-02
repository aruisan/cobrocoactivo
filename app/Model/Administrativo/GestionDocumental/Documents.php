<?php

namespace App\Model\Administrativo\GestionDocumental;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
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
}
