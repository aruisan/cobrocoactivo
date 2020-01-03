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
        $this->call(ModuloTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);  
        $this->call(VigenciasSeeder::class);  
        $this->call(LevelsTableSeeder::class);  
        $this->call(RegistersTableSeeder::class);  
        $this->call(RubrosTableSeeder::class);  
        $this->call(FontsTableSeeder::class);  
        $this->call(CodePadresTableSeeder::class);  
        $this->call(RegisterPucsTableSeeder::class);  
        $this->call(gPucsTableSeeder::class);  
   
        //$this->call(PersonaTableSeeder::class);
        //$this->call(PredioTableSeeder::class);
        //$this->call(ConteoTableSeeder::class);

    }
}
