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
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'view-users']);

        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'delete-categories']);
        Permission::create(['name' => 'view-categories']);

        Permission::create(['name' => 'create-products']);
        Permission::create(['name' => 'edit-products']);
        Permission::create(['name' => 'delete-products']);
        Permission::create(['name' => 'view-products']);

        Permission::create(['name' => 'profile-read']);
        Permission::create(['name' => 'profile-update']);
        Permission::create(['name' => 'profile-delete']);

        Permission::create(['name' => 'create-orders']);
        Permission::create(['name' => 'edit-orders']);
        Permission::create(['name' => 'delete-orders']);
        Permission::create(['name' => 'view-orders']);

        Permission::create(['name' => 'create-addresses']);
        Permission::create(['name' => 'edit-addresses']);
        Permission::create(['name' => 'delete-addresses']);
        Permission::create(['name' => 'view-addresses']);

        Permission::create(['name' => 'create-properties']);
        Permission::create(['name' => 'edit-properties']);
        Permission::create(['name' => 'delete-properties']);
        Permission::create(['name' => 'view-properties']);

        Permission::create(['name' => 'create-reviews']);
        Permission::create(['name' => 'edit-reviews']);
        Permission::create(['name' => 'delete-reviews']);
        Permission::create(['name' => 'view-reviews']);

        Permission::create(['name' => 'create-questions']);
        Permission::create(['name' => 'edit-questions']);
        Permission::create(['name' => 'delete-questions']);
        Permission::create(['name' => 'view-questions']);

        Permission::create(['name' => 'create-answers']);
        Permission::create(['name' => 'edit-answers']);
        Permission::create(['name' => 'delete-answers']);
        Permission::create(['name' => 'view-answers']);

        Permission::create(['name' => 'login-to-admin-panel']);


        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        $technicalSpecialist = Role::create(['name' => 'TechnicalSpecialist']);
        $director = Role::create(['name' => 'Director']);
        $manager = Role::create(['name' => 'Manager']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',

            'create-categories',
            'edit-categories',
            'delete-categories',
            'view-categories',

            'create-products',
            'edit-products',
            'delete-products',
            'view-products',

            'profile-read',
            'profile-update',
            'profile-delete',

            'login-to-admin-panel',

            'create-orders',
            'edit-orders',
            'delete-orders',
            'view-orders',

            'create-addresses',
            'edit-addresses',
            'delete-addresses',
            'view-addresses',

            'create-properties',
            'edit-properties',
            'delete-properties',
            'view-properties',

            'create-reviews',
            'delete-reviews',
            'view-reviews',

            'create-questions',
            'edit-questions',
            'delete-questions',
            'view-questions',

            'create-answers',
            'edit-answers',
            'delete-answers',
            'view-answers',
        ]);

        $userRole->givePermissionTo([
            'profile-read',
            'profile-update',
            'profile-delete',

            'create-orders',
            'edit-orders',
            'delete-orders',

            'create-reviews',
            'edit-reviews',
        ]);

        $technicalSpecialist->givePermissionTo([
            'profile-read',
            'profile-update',
            'profile-delete',

            'create-properties',
            'edit-properties',
            'delete-properties',
            'view-properties',

            'create-orders',
            'edit-orders',

            'create-reviews',
            'edit-reviews',

            'login-to-admin-panel',

        ]);
        $director->givePermissionTo([
            'profile-read',
            'profile-update',
            'profile-delete',

            'create-orders',
            'edit-orders',

            'create-addresses',
            'edit-addresses',
            'delete-addresses',

            'create-reviews',
            'edit-reviews',

            'login-to-admin-panel',
        ]);
        $manager->givePermissionTo([
            'profile-read',
            'profile-update',
            'profile-delete',

            'create-orders',
            'edit-orders',
            'view-orders',

            'create-addresses',
            'edit-addresses',
            'delete-addresses',
            'view-addresses',

            'create-products',

            'create-categories',
            'edit-categories',
            'delete-categories',
            'view-categories',

            'login-to-admin-panel',
        ]);
    }
}
