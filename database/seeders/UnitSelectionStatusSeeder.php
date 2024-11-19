<?php

namespace Database\Seeders;

use App\Models\membership\UnitSelectionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSelectionStatusSeeder extends Seeder
{
    public function run(): void
    {
        $unitSelectionStatusNames = [
            'قبول',
            'مردود'
        ];

        foreach ($unitSelectionStatusNames as $name) UnitSelectionStatus::create(['name' => $name]);
    }
}
