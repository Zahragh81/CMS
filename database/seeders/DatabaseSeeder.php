<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            GenderSeeder::class,
            OrganizationSeeder::class,

            RoleGroupSeeder::class,
            PermissionGroupSeeder::class,

            PermissionSeeder::class,
            RoleSeeder::class,

            UserSeeder::class,
        ]);
    }
}
