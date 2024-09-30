<?php

namespace Database\Seeders;

use App\Models\membership\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $documentTypes = [
            [
                'name' => 'کیفری'
            ],
            [
                'name' => 'حقوقی'
            ]
        ];

        foreach ($documentTypes as $documentType) DocumentType::create($documentType);
    }
}
