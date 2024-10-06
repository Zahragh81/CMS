<?php

namespace Database\Seeders;

use App\Models\membership\DocumentStatus;
use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $documentStatusNames = [
            'مفتوح',
            'مختومه',
            'راکد'
        ];

        foreach ($documentStatusNames as $name) DocumentStatus::create(['name' => $name]);

    }
}
