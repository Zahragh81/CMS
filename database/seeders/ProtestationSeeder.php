<?php

namespace Database\Seeders;

use App\Models\membership\Protestation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Morilog\Jalali\Jalalian;

class ProtestationSeeder extends Seeder
{
    public function run(): void
    {
        $protestations = [
            [
                'protestation_number' => '14526301',
                'protestation_date' => Jalalian::fromFormat('Y/m/d', '1401/10/05')->toCarbon()->toDateTimeString(),
                'protestation_text' => 'من این حکم را قبول ندارم شما باید...',
                'document_id' => 1,
                'protestation_status_id' => 1,
            ],
            [
                'protestation_number' => '963412874',
                'protestation_date' => Jalalian::fromFormat('Y/m/d', '1403/11/10')->toCarbon()->toDateTimeString(),
                'protestation_text' => 'من میخواهم که دوباره این پرونده را مورد بررسی قراردهید...',
                'document_id' => 2,
                'protestation_status_id' => 2,
            ],
        ];

        foreach ($protestations as $protestation) Protestation::create($protestation);
    }
}
