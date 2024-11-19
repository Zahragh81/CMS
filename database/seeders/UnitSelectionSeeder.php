<?php

namespace Database\Seeders;

use App\Models\membership\UnitSelection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSelectionSeeder extends Seeder
{
    public function run(): void
    {
        $unitSelections = [
            [
                'score' => '12',
                'lesson_offered_id' => 1,
                'student_id' => 1,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '8',
                'lesson_offered_id' => 2,
                'student_id' => 2,
                'unit_selection_status_id' => 2,
            ],
            [
                'score' => '20',
                'lesson_offered_id' => 3,
                'student_id' => 3,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '18.5',
                'lesson_offered_id' => 4,
                'student_id' => 4,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '5.5',
                'lesson_offered_id' => 5,
                'student_id' => 1,
                'unit_selection_status_id' => 2,
            ],
            [
                'score' => '14.25',
                'lesson_offered_id' => 6,
                'student_id' => 2,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '13',
                'lesson_offered_id' => 7,
                'student_id' => 3,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '17.25',
                'lesson_offered_id' => 8,
                'student_id' => 4,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '2',
                'lesson_offered_id' => 9,
                'student_id' => 1,
                'unit_selection_status_id' => 2,
            ],
            [
                'score' => '20',
                'lesson_offered_id' => 10,
                'student_id' => 2,
                'unit_selection_status_id' => 1,
            ],
            [
                'score' => '18.5',
                'lesson_offered_id' => 1,
                'student_id' => 3,
                'unit_selection_status_id' => 1,
            ],
        ];

        foreach ($unitSelections as $unitSelection) UnitSelection::create($unitSelection);
    }
}
