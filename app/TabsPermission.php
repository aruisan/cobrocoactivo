<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabsPermission extends Model
{
    public function modulos()
    {
    	return $this->hasMany('App\Model\Admin\Modulo');
    }
}
