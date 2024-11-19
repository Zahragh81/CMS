<?php

namespace Database\Seeders;

use App\Models\membership\LessonOffered;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonOfferedSeeder extends Seeder
{
    public function run(): void
    {
        $lessonsOffered = [
            [
                'lesson_id' => 1,
                'semester_id' => 1,
                'master_id' => 1,
            ],
            [
                'lesson_id' => 2,
                'semester_id' => 2 ,
                'master_id' => 2,
            ],
            [
                'lesson_id' => 3,
                'semester_id' => 3 ,
                'master_id' => 3,
            ],
            [
                'lesson_id' => 4,
                'semester_id' => 4,
                'master_id' => 4,
            ],
            [
                'lesson_id' => 5,
                'semester_id' => 5,
                'master_id' => 5,
            ],
            [
                'lesson_id' => 6,
                'semester_id' => 6,
                'master_id' => 6,
            ],
            [
                'lesson_id' => 7,
                'semester_id' => 7,
                'master_id' => 7,
            ],
            [
                'lesson_id' => 8,
                'semester_id' => 8,
                'master_id' => 8,
            ],
            [
                'lesson_id' => 9,
                'semester_id' => 1,
                'master_id' => 9,
            ],
            [
                'lesson_id' => 10,
                'semester_id' => 2,
                'master_id' => 1,
            ],
        ];

        foreach ($lessonsOffered as $lessonOffered) LessonOffered::create($lessonOffered);
    }
}
