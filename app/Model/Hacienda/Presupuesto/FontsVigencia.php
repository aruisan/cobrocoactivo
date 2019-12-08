<?php

namespace App\Model\Hacienda\Presupuesto;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FontsVigencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'fonts_vigencia';

    public function fontsRubro(){
        return $this->hasMany('App\Model\Hacienda\Presupuesto\FontsRubro','font_id');
    }

    public function font(){
        return $this->hasOne('App\Model\Hacienda\Presupuesto\Font','id','font_id');
    }

}
