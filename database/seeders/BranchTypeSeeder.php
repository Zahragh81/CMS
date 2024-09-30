<?php

namespace Database\Seeders;

use App\Models\membership\BranchType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchTypeSeeder extends Seeder
{
    public function run(): void
    {
        $branchtypes = [
            [
                'name' => 'کیفری'
            ],
            [
                'name' => 'حقوقی'
            ]
        ];

        foreach ($branchtypes as $branchtype) BranchType::create($branchtype);

    }
}
