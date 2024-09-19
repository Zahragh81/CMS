<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            // admin
            ['name' => 'manager', 'title' => 'مدیر سیستم', 'role_group_id' => 1],
        ];

        $permissions_ids = Permission::pluck('id');

        foreach ($roles as $role){
            $role = Role::create($role);

            if ($role->role_group_id == 1)
                $role->syncPermissions($permissions_ids);
        }
    }
}
