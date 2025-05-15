<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleRequestSeeder extends Seeder
{
    public function run(): void
    {
        // Create a few franchise_admins (multi-franchise selection)
        for ($i = 1; $i <= 2; $i++) {
            $user = User::firstOrCreate(
                ['email' => "admin_request{$i}@friospops.com"],
                [
                    'name' => "Admin Request {$i}",
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );

            RoleRequest::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'desired_role' => 'franchise_admin',
                    'franchisee_ids' => json_encode([1, 2]), // multi-franchise
                    'status' => 'pending'
                ]
            );
        }

        // Create a few franchise_staff (single-franchise selection)
        for ($i = 1; $i <= 3; $i++) {
            $user = User::firstOrCreate(
                ['email' => "staff_request{$i}@friospops.com"],
                [
                    'name' => "Staff Request {$i}",
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );

            RoleRequest::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'desired_role' => 'franchise_staff',
                    'franchisee_ids' => json_encode([1]), // single franchise
                    'status' => 'pending'
                ]
            );
        }
    }
}
