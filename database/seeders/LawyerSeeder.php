<?php

namespace Database\Seeders;

use App\Models\membership\Lawyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LawyerSeeder extends Seeder
{
    public function run(): void
    {
        $lawyers = [
            [
                'user_id' => 1,
                'office_name' => 'دفترشماره 1بیرجند',
                'office_address' => 'انتهای طالقانی ساختمان نجلا طبقه چهارم واحد 15',
                'office_phone' => '05612228355',
                'degree_id'  => 1,
            ],
            [
                'user_id' => 2,
                'office_name' => 'دفترشماره 3قزوین',
                'office_address' => 'خیابان بهشتی -بهشتی ۶-ساختمان اردیبهشت-طبقه چهارم',
                'office_phone' => '05632213985',
                'degree_id'  => 2,
            ],
            [
                'user_id' => 3,
                'office_name' => 'دفتر مرکزی اهواز',
                'office_address' => 'خیابان شهیدمطهری-بین مطهری۱۲و۱۴-پ۳۳',
                'office_phone' => '05632238851',
                'degree_id'  => 3,
            ],
        ];

        foreach ($lawyers as $lawyer) Lawyer::create($lawyer);
    }
}
