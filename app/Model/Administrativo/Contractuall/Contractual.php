<?php

namespace App\Model\Administrativo\Contractuall;

use Illuminate\Database\Eloquent\Model;

class Contractual extends Model
{
	protected $table = 'contractuales';

	public function registro()
	{
        return $this->belongsTo('App\Model\Administrativo\Registro\Registro','id');
	}  
}
