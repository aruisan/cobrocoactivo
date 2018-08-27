<?php

use App\Model\Cobro\Persona;
use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		 factory(Persona::class, 5)->create();
    }
}
