<?php

use App\Model\Hacienda\Presupuesto\Register;
use Illuminate\Database\Seeder;

class RegistersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Register::create([
           'name' => 'TOTAL GASTOS',
           'code' => 0,
           'register_id' => null,
           'level_id' => 1,
        ]);        

        Register::create([
           'name' => 'CONCEJO MUNICIPAL',
           'code' => 1,
           'register_id' => 1,
           'level_id' => 2,
        ]);

        Register::create([
           'name' => 'TOTAL GASTOS DE FUNCIONAMIENTO',
           'code' => 01,
           'register_id' => 2,
           'level_id' => 3,
        ]);

        Register::create([
           'name' => 'GASTOS DE FUNCIONAMIENTO',
           'code' => 01,
           'register_id' => 3,
           'level_id' => 4,
        ]);

        Register::create([
           'name' => 'TOTAL GASTOS GENERALES',
           'code' => 02,
           'register_id' => 3,
           'level_id' => 4,
        ]);

        Register::create([
           'name' => 'TRANSFERENCIAS CORRIENTES',
           'code' => 03,
           'register_id' => 3,
           'level_id' => 4,
        ]);

        Register::create([
           'name' => 'GASTOS DE PERSONAL',
           'code' => 00,
           'register_id' => 4,
           'level_id' => 5,
        ]);

        Register::create([
           'name' => 'GASTOS GENERALES',
           'code' => 00,
           'register_id' => 5,
           'level_id' => 5,
        ]);

        Register::create([
           'name' => 'OTRAS TRANSFERENCIAS CORRIENTES',
           'code' => 00,
           'register_id' => 6,
           'level_id' => 5,
        ]);

        Register::create([
           'name' => 'SERVICIOS PERSONALES ASOCIADOS A LA NOMINA',
           'code' => 01,
           'register_id' => 7,
           'level_id' => 6,
        ]);        


        Register::create([
           'name' => 'SERVICIOS PERSONALES INDIRECTOS',
           'code' => 02,
           'register_id' => 7,
           'level_id' => 6,
        ]);

        Register::create([
           'name' => 'CONTRIBUCIONES INHERENTES A LA NOMINA SECTOR PRIVADO',
           'code' => 03,
           'register_id' => 7,
           'level_id' => 6,
        ]);

        Register::create([
           'name' => 'ADQUISICIÓN DE BIENES',
           'code' => 01,
           'register_id' => 8,
           'level_id' => 6,
        ]);

        Register::create([
           'name' => 'ADQUISICIÓN DE SERVICIOS',
           'code' => 02,
           'register_id' => 8,
           'level_id' => 6,
        ]);

        Register::create([
           'name' => 'DESTINATARIOS DE LAS OTRAS TRANSFERENCIAS CORRIENTES',
           'code' => 01,
           'register_id' => 9,
           'level_id' => 6,
        ]);


    }
}
