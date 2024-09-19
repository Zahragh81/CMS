<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $genders = [
            [
                'name' => 'مرد'
            ],
            [
                'name' => 'زن'
            ]
        ];

        DB::table('genders')->insert($genders);
    }
}
