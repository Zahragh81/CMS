<?php

namespace Database\Seeders;

use App\Models\membership\Judges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JudgesSeeder extends Seeder
{
    public function run(): void
    {
        $judges = [
            [
                'user_id' => 1,
                'court_branch_id' => 1,
                'organizational_post_id' => 1,
            ],

            [
                'user_id' => 2,
                'court_branch_id' => 2,
                'organizational_post_id' => 2
            ],
            [
                'user_id' => 3,
                'court_branch_id' => 1,
                'organizational_post_id' => 1,
            ]
        ];

        foreach ($judges as $judge) Judges::create($judge);
    }
}
