<?php

namespace Database\Seeders;

use App\Models\membership\DocumentStatus;
use App\Models\membership\Situation;
use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $documentStatuses = [
            [
                'name' => 'مفتوح'
            ],
            [
                'name' => 'مختومه'
            ],
            [
                'name' => 'راکد'
            ]
        ];

        foreach ($documentStatuses as $documentStatus) DocumentStatus::create($documentStatus);

    }
}
