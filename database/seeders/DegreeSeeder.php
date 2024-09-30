<?php

namespace Database\Seeders;

use App\Models\membership\Degree;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        $degrees = [
            [
                'name' => 'پایه یک '
            ],
            [
                'name' => 'پایه دو'
            ],
            [
                'name' => 'پایه سه'
            ]
        ];

        foreach ($degrees as $degree) Degree::create($degree);
    }
}
