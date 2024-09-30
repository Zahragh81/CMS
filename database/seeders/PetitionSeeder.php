<?php

namespace Database\Seeders;

use App\Models\membership\Petition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Morilog\Jalali\Jalalian;

class PetitionSeeder extends Seeder
{
    public function run(): void
    {
        $petitions = [
            [
                'document_id' =>  1,
                'petition_number' => '52364194',
                'petition_date' => Jalalian::fromFormat('Y/m/d', '1403/06/25')->toCarbon()->toDateTimeString(),
                'petition_text' => 'این جانب درخواست طلاق دارم',
            ],
            [
                'document_id' =>  2,
                'petition_number' => '98412036',
                'petition_date' => Jalalian::fromFormat('Y/m/d', '1403/04/26')->toCarbon()->toDateTimeString(),
                'petition_text' => 'این جانبت درخواست شکایت از همسر به علت ضرب و شتم را دارم',
            ]
        ];

        foreach ($petitions as $petition) Petition::create($petition);
    }
}
