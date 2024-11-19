<?php

namespace Database\Seeders;

use App\Models\membership\Master;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        $masters = [
            [
                'first_name' => 'حمید',
                'last_name' => 'سعادت فر'
            ],
            [
                'first_name' => 'حسنیه',
                'last_name' => 'ذولفقاری'
            ],
            [
                'first_name' => 'مهدی',
                'last_name' => 'خزائی پور'
            ],
            [
                'first_name' => 'ملیکا',
                'last_name' => 'قاسمی'
            ],
            [
                'first_name' => 'امین',
                'last_name' => 'ابریشمی مقدم'
            ],
            [
                'first_name' => 'حامد',
                'last_name' => 'صباغ گل'
            ],
            [
                'first_name' => 'امیر',
                'last_name' => 'حسن پور'
            ],
            [
                'first_name' => 'شیما',
                'last_name' => 'حسینی'
            ],
            [
                'first_name' => 'هادی',
                'last_name' => 'چهکندی نژاد'
            ],
        ];

        foreach ($masters as $master) Master::create($master);
    }
}
