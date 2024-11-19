<?php

namespace Database\Seeders;

use App\Models\membership\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $semesterTitles = [
            'مهر 1401',
            'بهمن 1401',
            'مهر 1402',
            'بهمن 1402',
            'مهر 1403',
            'بهمن 1403',
            'مهر 1404',
            'بهمن 1404'
        ];

        foreach ($semesterTitles as $title) Semester::create(['title' => $title]);
    }
}
