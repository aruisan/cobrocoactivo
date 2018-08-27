<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
     protected $table = 'asignaciones';

     protected $fillable = ['abogado_id', 'secretaria_id', 'cc_id', 'tabla'];


     public function predio()
     {
     	return  $this->belongsTo('App\Model\Cobro\Predio' , 'cc_id');
     }     

     public function abogado()
     {
     	return  $this->belongsTo('App\User' , 'abogado_id');
     }    

     public function secretaria()
     {
     	return  $this->belongsTo('App\User' , 'secretaria_id');
     }
}
