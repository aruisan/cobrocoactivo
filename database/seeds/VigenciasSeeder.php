<?php

use App\Model\Hacienda\Presupuesto\Vigencia;
use Illuminate\Database\Seeder;

class VigenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vigencia::create([
           'vigencia' => 2019,
           'tipo' => 0,
           'numero_decreto' => 01,
           'fecha' =>  '2019-02-04',
           'ultimo' =>  6,
           'presupuesto_inicial' =>  2323242423,
           'user_id' => 1,
        ]);

    }
}
