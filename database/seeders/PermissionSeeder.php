<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // 1️⃣ Define all roles
        $roles = [
            'super_admin',
            'corporate_admin',
            'franchise_admin',
            'franchise_manager',
            'franchise_staff',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 2️⃣ Define permissions
        $permissions = [
            'manage users',
            'view reports',
            'assign inventory',
            'edit franchise settings',
            'create events',
            'check-in event sales',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3️⃣ Assign permissions to roles
        $matrix = [
            'super_admin' => $permissions,
            'corporate_admin' => $permissions,
            'franchise_admin' => [
                'manage users',
                'view reports',
                'assign inventory',
                'edit franchise settings',
                'create events',
                'check-in event sales',
            ],
            'franchise_manager' => [
                'view reports',
                'assign inventory',
                'create events',
                'check-in event sales',
            ],
            'franchise_staff' => [
                'assign inventory',
                'check-in event sales',
            ],
        ];

        foreach ($matrix as $role => $perms) {
            Role::findByName($role)->syncPermissions($perms);
        }
    }
}

