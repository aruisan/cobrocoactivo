<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Cobro\Persona::class, function (Faker $faker) {
    return [
           
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'num_dc' => $faker->randomNumber, // secret
        'direccion' => $faker->address, // secret
        'tipo' =>  $faker->randomElement( array('JURIDICA','NATURAL')),
        'telefono' => $faker->randomNumber, // secret
        
    ];
});
