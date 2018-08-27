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
                'nombre' => 'Juez',
        ]);

        Type::create([
                'nombre' => 'Coordinador',
        ]);
                
        Type::create([
                'nombre' => 'Abogado',
        ]);        

        Type::create([
                'nombre' => 'Secretaria',
        ]);        

    }
}
