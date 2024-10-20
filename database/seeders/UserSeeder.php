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
                'first_name' => 'زهرا',
                'last_name' => 'قلیزاده',
                'mobile' => '09928458681',
                'password' => '0640788971',
                'gender_id' => '1',
                'organization_id' => '1'
            ],
            [
                'username' => '5630161237',
                'first_name' => 'زهرا',
                'last_name' => 'هاشمی',
                'mobile' => '09018812581',
                'password' => '5630161237',
                'gender_id' => '1',
                'organization_id' => '2'
            ],
            [
                'username' => '0640949797',
                'first_name' => 'حمیده',
                'last_name' => 'بهشتی',
                'mobile' => '09336957847',
                'password' => '0640949797',
                'gender_id' => '1',
                'organization_id' => '2'
            ],
            [
                'username' => '0640634810',
                'first_name' => 'تارا',
                'last_name' => 'قلیزاده',
                'mobile' => '09905637211',
                'password' => '0640634810',
                'gender_id' => '1',
                'organization_id' => '1'
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);

            $user->assignRole([1]);
        }
    }
}
