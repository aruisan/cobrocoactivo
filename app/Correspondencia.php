<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ResourceTraits;

class Correspondencia extends Model
{
     static function store($request)
     {
         if ($request->tipo_doc == 0){

             $file = new ResourceTraits;
             $resource = $file->resource($request->fileCorrespondenciaE, 'public/CorrespondenciaEntrada');

             $user_id = $request->id_resp;
             $type = "Correspondencia entrada";
             $name = $request->name;
             $ff_doc = $request->ff_doc;
             $tercero_id = $request->tercero;
             $number_doc = $request->num_doc;
             $ff_vence = $request->ff_vence;
             $estado = $request->estado;
             $cc_id = $request->cc_id;
             $ff_salida = $request->ff_salida;
             $ff_aprobacion = $request->ff_aprobacion;
             $respuesta = $request->respuesta;
             $resource_id = $resource;

             $Documents = new Documents();
             $Documents->ff_document = $ff_doc;
             $Documents->ff_salida = $ff_salida;
             $Documents->ff_primerdbte = $ff_doc;
             $Documents->ff_segundodbte = $ff_doc;
             $Documents->ff_aprobacion = $ff_aprobacion;
             $Documents->ff_sancion = $ff_doc;
             $Documents->ff_vence = $ff_vence;
             $Documents->type = $type;
             $Documents->cc_id = $cc_id;
             $Documents->name = $name;
             $Documents->respuesta = $respuesta;
             $Documents->number_doc = $number_doc;
             $Documents->estado = $estado;
             $Documents->resource_id = $resource_id;
             $Documents->user_id = $user_id;
             $Documents->tercero_id = $tercero_id;
             $Documents->save();

         }elseif ($request->tipo_doc == 1){

             $file = new ResourceTraits;
             $resource = $file->resource($request->fileCorrespondenciaS, 'public/CorrespondenciaEntrada');

             $user_id    = $request->id_resp;
             $type       = "Correspondencia salida";
             $name    = $request->name;
             $ff_doc       = $request->fecha_doc;
             $tercero_id   = $request->tercero;
             $number_doc   = $request->num_doc;
             $ff_vence   = $request->ff_vence;
             $estado   = $request->estado;
             $cc_id = $request->consecutivo;
             $resource_id   = $resource;

             $Documents = new Documents();
             $Documents->ff_document = $ff_doc;
             $Documents->ff_salida = $ff_doc;
             $Documents->ff_primerdbte = $ff_doc;
             $Documents->ff_segundodbte = $ff_doc;
             $Documents->ff_aprobacion = $ff_doc;
             $Documents->ff_sancion = $ff_doc;
             $Documents->ff_vence = $ff_vence;
             $Documents->type = $type;
             $Documents->cc_id = $cc_id;
             $Documents->name = $name;
             $Documents->respuesta = $name;
             $Documents->number_doc = $number_doc;
             $Documents->estado = $estado;
             $Documents->resource_id = $resource_id;
             $Documents->user_id = $user_id;
             $Documents->tercero_id = $tercero_id;
             $Documents->save();

         }


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
