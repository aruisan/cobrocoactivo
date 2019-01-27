<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ResourceTraits;

class Correspondencia extends Model
{
     static function store($request)
     {
     	$file = new ResourceTraits;
     	$resource = $file->resource($request, 'public/correspondencia');

     	//dd($request->fecha_venc);
     	$correspondencia = new Correspondencia;
     	$correspondencia->fecha_vencimiento = $request->fecha_venc;
     	$correspondencia->user_id = $request->user;
     	$correspondencia->persona_id = $request->tercero;
     	$correspondencia->resource_id = $resource;
     	$correspondencia->save();
     }


     public function user(){
     	return $this->belongsTo('App\User', 'user_id');
     }

     public function persona(){
     	return $this->belongsTo('App\Model\Persona', 'persona_id');
     }

     public function resource()
     {
     	return $this->belongsTo('App\Resource', 'resource_id');
     }
}
