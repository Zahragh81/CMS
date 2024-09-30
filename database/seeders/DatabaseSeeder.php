<?php

namespace Database\Seeders;

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

            ProvinceSeeder::class,
            CitySeeder::class,

            BranchTypeSeeder::class,
            CourtBrancheSeeder::class,

            OrganizationalPostSeeder::class,

            JudgesSeeder::class,

            DegreeSeeder::class,
            LawyerSeeder::class,

            DocumentTypeSeeder::class,
            DocumentStatusSeeder::class,
            DocumentSeeder::class,

            PetitionSeeder::class,
        ]);
    }
}
