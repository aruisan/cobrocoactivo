<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{

  public function dependencias(){
    return $this->belongsToMany('App\Model\Admin\Dependencia','dependencia_ruta_type')->withPivot('type_id','dias','id');
   }
 
  public function types(){
      return $this->belongsToMany('App\Model\Cobro\Type','dependencia_ruta_type')
     ->withPivot('dependencia_id','dias');
  }
}
