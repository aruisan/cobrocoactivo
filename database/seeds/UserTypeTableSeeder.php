<?php

use App\Model\Cobro\Type;
use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
                'nombre' => 'Juez CobroCoactivo',
                'asignar' => 1,
        ]);

        Type::create([
                'nombre' => 'Coordinador CobroCoactivo',
                'asignar' => 1,
        ]);
                
        Type::create([
                'nombre' => 'Abogado CobroCoactivo',
                'asignar' => 1,
        ]);        

        Type::create([
                'nombre' => 'Secretaria CobroCoactivo',
        ]);      

        Type::create([
                'nombre' => 'Secretaria Dependencia',
        ]);  

        Type::create([
                'nombre' => 'Administrador Dependencia',
        ]);    

    }
}
