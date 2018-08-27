<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(PredioTableSeeder::class);
        $this->call(ConteoTableSeeder::class);
    }
}
