<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Cobro\Predio::class, function (Faker $faker) {
    return [

    'ficha_catastral' => $faker->unique()->randomNumber,
  	'matricula_inmobiliaria'=> $faker->randomNumber,
    'direccion_predio' => $faker->address,
    'nombre_predio' => $faker->name,
    'a_hectareas' => $faker->randomNumber,
    'a_metros' => $faker->randomNumber,
    'a_construida' => $faker->randomNumber,
    'avaluo' => $faker->randomNumber,
    'tipo_tarifa' => $faker->randomNumber,
    'destino_economico' => $faker->randomNumber,
    'porc_tarifa' => $faker->randomNumber,
    'estrato' => $faker->randomNumber,
    'observacion' => $faker->randomNumber,
    'v_declarado' => $faker->randomNumber,
    'impuesto_predial'=> $faker->randomNumber, 
    'interes_predial'=> $faker->randomNumber ,
    'contribucion_car' => $faker->randomNumber,
    'interes_Car' => $faker->randomNumber,
    'otros_conceptos' => $faker->randomNumber,
    'cuantia' => $faker->randomNumber,
    'inicio' => \Carbon\Carbon::now(),
    'final' => \Carbon\Carbon::now(),
    'existe' => 1,
    'ubicacion' => $faker->address,
    'exento' => $faker->randomNumber,
    'semaforo' => $faker->randomNumber,
    'estado' =>  $faker->randomElement( array('1','0')),


    ];
});
