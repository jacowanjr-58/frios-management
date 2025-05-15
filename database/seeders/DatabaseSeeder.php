<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\FlavorCategorySeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    // other seeders...
    $this->call(DevUserSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(RolesAndSuperAdminSeeder::class);
    $this->call(FranchiseeAdminSeeder::class);
    $this->call(FlavorCategorySeeder::class);

    $corporate = \App\Models\Franchisee::firstOrCreate([
        'name' => 'Corporate',
    ]);

    }
}
