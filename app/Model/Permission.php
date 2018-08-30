<?php

namespace App\Molde;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Permission extends Model
{  

   public function modulo()
   {
        return $this->belongsTo('App\Model\Admin\Modulo');
   }
}
