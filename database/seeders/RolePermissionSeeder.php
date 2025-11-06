<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create roles
        $admin =  Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        //create permission list
        $permissions =  [
            'create artist',
            'edit artist',
            'delete artist',
            'view artist'
        ];

        //create permission in db
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        //give all permissions to admin
        $admin->givePermissionTo($permissions);

        //give only view permission to normal user
        $user->givePermissionTo(['view artist']);
    }
}
