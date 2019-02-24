<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CodePadre extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'code_padres';

    public function register(){
    	return $this->belongsTo('App\Model\Hacienda\Presupuesto\Register');
    }

    public function registers()
    {
    	return $this->belongsTo('App\Model\Hacienda\Presupuesto\Register', 'register2_id');
    }
}
