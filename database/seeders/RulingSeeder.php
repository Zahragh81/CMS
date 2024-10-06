<?php

namespace Database\Seeders;

use App\Models\membership\Ruling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Morilog\Jalali\Jalalian;

class RulingSeeder extends Seeder
{
    public function run(): void
    {
        $rulings = [
            [
                'judgment_number' => '12345879',
                'judgment_date' => Jalalian::fromFormat('Y/m/d', '1403/05/18')->toCarbon()->toDateTimeString(),
                'judgment_text' => 'باتوجه به اینکه فرد محکوم به حبس ابد هست ...',
                'document_id' => 1,
                'ruling_status_id' => 1,
            ],
            [
                'judgment_number' => '84259630',
                'judgment_date' => Jalalian::fromFormat('Y/m/d', '1401/12/09')->toCarbon()->toDateTimeString(),
                'judgment_text' => 'فرد محکوم به قتل غیر عمد است طبق قانون ...',
                'document_id' => 2,
                'ruling_status_id' => 2,
            ]
        ];

        foreach ($rulings as $ruling) Ruling::create($ruling);
    }
}
