<?php

namespace Database\Seeders;

use App\Models\RoleGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleGroupSeeder extends Seeder
{
    public function run(): void
    {
        $roleGroupNames = [
            'نقش های مدیران'
        ];

        foreach ($roleGroupNames as $name) RoleGroup::create(['name' => $name]);
    }
}
