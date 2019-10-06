<?php

use App\Model\User;
use App\Model\Cobro\UserBoss;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       $user = User::create([
           'name' => 'Admin',
           'email' => 'Admin@admin.com',
           'password' => bcrypt('123456'),
        ]);  

       $user->assignRole('administrador');

        User::create([
           'name' => 'yoe',
           'email' => 'yoe@yoe.com',
           'type_id' => 3,
           'password' => bcrypt('123456'),
        ]);

    }
}
