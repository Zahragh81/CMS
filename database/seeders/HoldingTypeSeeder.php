<?php

namespace Database\Seeders;

use App\Models\membership\HoldingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoldingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $holdingTypeNames = [
            'حضوری',
            'انلاین'
        ];

        foreach ($holdingTypeNames as $name) HoldingType::create(['name' => $name]);
    }
}
