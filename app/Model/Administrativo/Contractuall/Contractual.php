<?php

namespace App\Model\Administrativo\Contractuall;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Contractual extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'contractuales';

	public function registro()
	{
        return $this->belongsTo('App\Model\Administrativo\Registro\Registro','id');
	}  
}
