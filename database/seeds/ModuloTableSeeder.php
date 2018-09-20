<?php

use Illuminate\Database\Seeder;
use App\Model\Admin\Modulo;

class ModuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::create(['name' => 'Roles']);
        Modulo::create(['name' => 'Funcionarios']);
        Modulo::create(['name' => 'Dependencias']);
    }
}
