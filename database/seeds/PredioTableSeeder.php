<?php

use App\Model\Cobro\Predio;
use Illuminate\Database\Seeder;

class PredioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	factory(Predio::class, 50)->create();
    }
}
