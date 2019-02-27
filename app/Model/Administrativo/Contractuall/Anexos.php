<?php

namespace App\Model\Administrativo\Contractuall;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Anexos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'anexos_contractual';

    public function resource()
    {
        return $this->belongsTo('App\Resource', 'resource_id');
    }
}
