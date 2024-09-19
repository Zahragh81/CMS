<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            //organization
            ['name' => 'organizations_index', 'title' => 'فهرست سازمان ها', 'permission_group_id' => 1],
            ['name' => 'organizations_create', 'title' => 'ایجاد سازمان ها', 'permission_group_id' => 1],
            ['name' => 'organizations_show', 'title' => 'مشاهده سازمان ها', 'permission_group_id' => 1],
            ['name' => 'organizations_edit', 'title' => 'ویرایش سازمان ها', 'permission_group_id' => 1],
            ['name' => 'organizations_destroy', 'title' => 'حذف سازمان ها', 'permission_group_id' => 1],

            // User
            ['name' => 'user_index', 'title' => 'فهرست کاربران', 'permission_group_id' => 2],
            ['name' => 'user_creat', 'title' => 'ایجاد کاربران', 'permission_group_id' => 2],
            ['name' => 'user_show', 'title' => 'مشاهده کاربران ', 'permission_group_id' => 2],
            ['name' => 'user_edit', 'title' => 'ویرایش کاربران', 'permission_group_id' => 2],
            ['name' => 'user_destroy', 'title' => 'حذف کاربران', 'permission_group_id' => 2],
        ];

        foreach ($permissions as $permission) Permission::create($permission);
    }
}
