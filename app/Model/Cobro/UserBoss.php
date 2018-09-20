<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class UserBoss extends Model
{
   	protected $table = 'user_boss';

    protected $fillable = [
        'user_id', 
        'user_boss', 
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function boss()
    {
    	return $this->belongsTo('App\User', 'boss_id');
    }
}
