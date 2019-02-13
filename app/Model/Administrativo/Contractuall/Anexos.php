<?php

namespace App\Model\Administrativo\Contractuall;

use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{
	protected $table = 'anexos_contractual';

    public function resource()
    {
        return $this->belongsTo('App\Resource', 'resource_id');
    }
}
