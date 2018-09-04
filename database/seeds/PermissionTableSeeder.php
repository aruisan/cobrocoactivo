<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete'
        ];

        $fun = [
           'funcionario-list',
           'funcionario-create',
           'funcionario-edit',
           'funcionario-delete'
        ];

        $dep = [
           'dependencia-list',
           'dependencia-create',
           'dependencia-edit',
           'dependencia-delete'
        ];

        $role = Role::create(['name' => 'administrador']);
        foreach ($roles as $rol) {
            $permission = Permission::create([
                                  'name' => $rol,
                                  'modulo_id' => 1
                                ]);
            $role->givePermissionTo($permission);
        }

        foreach ($fun as $f) {
            $permissionf = Permission::create([
                                   'name' => $f,
                                   'modulo_id' => 2
                                 ]);
            $role->givePermissionTo($permissionf);
        }

        foreach ($dep as $d) {
            $permissiond = Permission::create([
                                   'name' => $d,
                                   'modulo_id' => 3
                                 ]);
            $role->givePermissionTo($permissiond);
        }

        foreach ($roles as $rol){
            $permission = Permission::where('name', $rol)->first();
            $role->givePermissionTo($permission);
        }

        foreach ($fun as $f) {
            $permissionf = Permission::where('name', $f)->first();
            $role->givePermissionTo($permissionf);
        }

        foreach ($dep as $d) {
            $permissiond = Permission::where('name', $d)->first();
            $role->givePermissionTo($permissiond);
        }
    }
}
