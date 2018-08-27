<?php

use App\Model\User;
use App\Model\Cobro\UserBoss;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
           'name' => 'Admin',
           'email' => 'Admin@admin.com',
           'admin' => '1',
           'password' => bcrypt('123456'),
        ]);        

        User::create([
           'name' => 'yoe',
           'email' => 'yoe@yoe.com',
           'type_id' => 3,
           'password' => bcrypt('123456'),
        ]);

        /*factory(User::class, 20)->create()->each(function ($u) {

              $type_id = $u->type->id;

              if ($type_id <> 1 ) {

                    $boss_id = User::whereHas('type', function ($query) use ($type_id) {
                        $query->where('id',$type_id-1);
                        })->pluck('id')->random();

                    UserBoss::create([
                        'user_id' => $u->id,
                        'boss_id' => $boss_id,
                    ]);
              }

        });

        /*$boss_id_static = User::whereHas('type', function ($query){
                              $query->where('id', 2);
                          })->pluck('id')->random();

        UserBoss::create([
                  'user_id' => 2,
                  'boss_id' => $boss_id_static,
        ]);*/

    }
}
