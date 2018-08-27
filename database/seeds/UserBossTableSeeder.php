<?php

use App\Model\Cobro\UserBoss;
use Illuminate\Database\Seeder;

class UserBossTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(UserBoss::class, 20)->create();
    }
}
