<?php

use App\Model\Hacienda\Presupuesto\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
           'name' => 'Nivel 1',
           'level' => 1,
           'cifras' => 1,
           'rows' => 1,
           'vigencia_id' => 1,
        ]);        

        Level::create([
           'name' => 'Nivel 2',
           'level' => 2,
           'cifras' => 1,
           'rows' => 1,
           'vigencia_id' => 1,
        ]);        

        Level::create([
           'name' => 'Nivel 3',
           'level' => 3,
           'cifras' => 2,
           'rows' => 1,
           'vigencia_id' => 1,
        ]);        

        Level::create([
           'name' => 'Nivel 4',
           'level' => 4,
           'cifras' => 2,
           'rows' => 3,
           'vigencia_id' => 1,
        ]);        

        Level::create([
           'name' => 'Nivel 5',
           'level' => 5,
           'cifras' => 3,
           'rows' => 3,
           'vigencia_id' => 1,
        ]);        

        Level::create([
           'name' => 'Nivel 6',
           'level' => 6,
           'cifras' => 2,
           'rows' => 6,
           'vigencia_id' => 1,
        ]);
    }
}
