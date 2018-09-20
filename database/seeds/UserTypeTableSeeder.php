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
        ]);

        Type::create([
                'nombre' => 'Coordinador CobroCoactivo',
        ]);
                
        Type::create([
                'nombre' => 'Abogado CobroCoactivo',
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
