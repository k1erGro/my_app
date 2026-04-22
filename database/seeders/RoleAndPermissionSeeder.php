<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'delete-categories']);

        Permission::create(['name' => 'create-products']);
        Permission::create(['name' => 'edit-products']);
        Permission::create(['name' => 'delete-products']);

        Permission::create(['name' => 'profile-read']);
        Permission::create(['name' => 'profile-update']);
        Permission::create(['name' => 'profile-delete']);

        Permission::create(['name' => 'login-to-admin-panel']);


        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'edit-users',
            'delete-users',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'create-products',
            'edit-products',
            'delete-products',
            'profile-read',
            'profile-update',
            'profile-delete',
            'login-to-admin-panel',
        ]);

        $userRole->givePermissionTo([
            'profile-read',
            'profile-update',
            'profile-delete',
        ]);
    }
}
