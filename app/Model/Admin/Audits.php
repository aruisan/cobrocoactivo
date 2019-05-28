<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Audits extends Model
{
    protected $table = 'audits';

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
