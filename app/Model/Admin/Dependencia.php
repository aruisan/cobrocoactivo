<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Dependencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public function subProyectos(){
		return $this->hasMany('App\Model\Planeacion\Pdd\SubProyecto','dependencia_id');
	}

	public function users(){
		return $this->hasMany('App\User','dependencia_id');
	}

  public function cdps(){
      return $this->hasMany('App\Model\Hacienda\Presupuesto\Cdp\Cdp','dependencia_id');
  }

  public function rutas(){
    return $this->belongsToMany('App\Model\Cobro\Ruta','dependencia_ruta_type')->withPivot('type_id','dias');;
  }
 
  public function types(){
    return $this->belongsToMany('App\Model\Cobro\Type','dependencia_ruta_type')->withPivot('ruta_id','dias');
  }

}
