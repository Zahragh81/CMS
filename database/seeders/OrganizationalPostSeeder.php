<?php

namespace Database\Seeders;

use App\Models\membership\OrganizationalPost;
use Illuminate\Database\Seeder;

class OrganizationalPostSeeder extends Seeder
{
    public function run(): void
    {
        $organizationalposts = [
            [
                'name' => 'قاضی'
            ],
            [
                'name' => 'رئیس دفتر'
            ],
            [
                'name' => 'منشی'
            ],
            [
                'name' => 'بایگانی'
            ]
        ];

        foreach ($organizationalposts as $organizationalpost) OrganizationalPost::create($organizationalpost);
    }
}
