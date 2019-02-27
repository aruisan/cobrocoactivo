<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Font extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function fontsRubro(){
		return $this->hasMany('App\FontsRubro','font_id');
	}
}
