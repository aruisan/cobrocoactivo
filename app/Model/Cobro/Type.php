<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'nombre', 
    ];


    public function users()
    {
        return $this->hasMany('App\User');
    }


    public function rutas(){
      return $this->belongsToMany('App\Model\Cobro\Ruta','dependencia_ruta_type')->withPivot('dependencia_id','dias');;
    }
 
    public function dependencias(){
        return $this->belongsToMany('App\Model\Admin\Dependencia','dependencia_ruta_type')->withPivot('ruta_id','dias');
    }
}
