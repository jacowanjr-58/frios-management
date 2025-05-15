<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DevUserSeeder extends Seeder
{
    public function run()
    {
        // map of roles → fake user IDs

        $map = [
            'super_admin'       => 100_000_001,
            'corporate_admin'   => 100_000_002,
            'franchise_admin'   => 100_000_003,
            'franchise_manager' => 100_000_004,
            'franchise_staff'   => 100_000_005,
        ];

        foreach ($map as $role => $id) {
            // insert or update the user row with that ID
            DB::table('users')->updateOrInsert(
                ['id' => $id],
                [
                    'name'       => Str::title(str_replace('_', ' ', $role)) . ' Dev',
                    'email'      => "dev_{$role}@example.test",
                    'password'   => bcrypt('password'),  // or whatever
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // assign the Spatie role
            $user = User::find($id);
            $user->assignRole($role);
        }

        // bump users auto-increment past our fake IDs
        $max = max(array_values($map)) + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT = {$max}");
    }
}

