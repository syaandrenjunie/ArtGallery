<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);


        // permissions for artist module
        $artistPermissions = [
            'create artist',
            'edit artist',
            'delete artist',
            'view artist',
        ];

        // permissions for artwork module
        $artworkPermissions = [
            'create artwork',
            'edit artwork',
            'delete artwork',
            'view artwork',
        ];

        // merge both permission groups
        $permissions = array_merge($artistPermissions, $artworkPermissions);

        // create permissions in DB
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // admin gets all permissions
        $admin->givePermissionTo($permissions);

        // normal user can only *view* both artist and artwork
        $user->givePermissionTo([
            'view artist',
            'view artwork',
        ]);
    }
}
