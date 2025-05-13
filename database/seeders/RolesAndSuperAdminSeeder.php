<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

          // 1️⃣ Reset cached permissions & roles
          app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

          // 2️⃣ Create your roles
          $roles = ['super_admin','corporate_admin','franchise_admin','franchise_manager','franchise_staff'];
          foreach ($roles as $r) {
              Role::firstOrCreate(['name' => $r]);
          }

          // 3️⃣ Seed the super_admin user

        Role::firstOrCreate(['name' => 'super_admin']);
        $user = User::firstOrCreate(
            ['email' => 'jacowanjr@gmail.com'],
            ['name' => 'Your Name', 'password' => bcrypt('secure-password')]
        );
        $user->assignRole('super_admin');
    }
}
