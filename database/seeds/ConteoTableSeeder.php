<?php

use App\Model\Cobro\Conteo;
use Illuminate\Database\Seeder;

class ConteoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conteo::create([
                'tabla' => 'predios',
                'valor' => 0,
        ]);        

    }
}
