<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model; 


class Permission extends Model
{
 

    protected $fillable = ['name','modulo_id','activo'];



   public function modulo()
   {
        return $this->belongsTo('App\Model\Admin\Modulo');
   }
}
