<?php

namespace Database\Seeders;

use App\Models\membership\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            [
                'name' => 'مشهد',
                'parent_id' => 11
            ],
            [
                'name' => 'بیرجند',
                'parent_id' => 10
            ],
            [
                'name' => 'زاهدان',
                'parent_id' => 16
            ]
        ];

        foreach ($cities as $city) City::create($city);
    }
}
