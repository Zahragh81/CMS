<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    public function run(): void
    {
        $permissionGroupNames = [
            'کاربران',
            'سازمان ها'
        ];

        foreach ($permissionGroupNames as $name) PermissionGroup::create(['name' => $name]);
    }
}
