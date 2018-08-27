<?php

use App\Model\User;
use Faker\Generator as Faker;

$factory->define(App\Model\Cobro\UserBoss::class, function (Faker $faker) {
    
	$user_id = User::all()->random();
	


	$tipo = $user_id->type->id;
	
	if($tipo <> 1){
		$boss_id = User::whereHas('type', function ($query) use ($tipo) {
	                            $query->where('id',$tipo-1);
	                        })->pluck('id')->random();

	    return [
	           
	        'user_id' => $user_id->id,
	        'boss_id' => $boss_id,
	        
	    ];

	}
});
