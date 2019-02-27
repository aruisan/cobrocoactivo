<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type_id','dependencia_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function type()
    {
        return $this->belongsTo('App\Model\Cobro\Type');
    }  

    public function dependencia()
    {
        return $this->belongsTo('App\Model\Admin\Dependencia');
    }     

    public function user_boss()
    {
        return $this->hasOne('App\Model\Cobro\UserBoss');
    }

    public function boss_users()
    {
        return $this->hasMany('App\Model\Cobro\UserBoss', 'boss_id');
    }
}
