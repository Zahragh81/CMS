<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => '0640788971',
                'first_name' => 'zahra',
                'last_name' => 'gholizadeh',
                'mobile' => '09928458681',
                'password' => '123456',
                'genders_id' => '1',
                'organizations_id' => '1'
            ],
            [
                'username' => '5630161237',
                'first_name' => 'zahra',
                'last_name' => 'hashemi',
                'mobile' => '0938485943',
                'password' => '123456',
                'genders_id' => '1',
                'organizations_id' => '2'
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);

            $user->assignRole([1]);
        }
    }
}
