<?php

namespace Database\Seeders;

use App\Models\membership\ReferralType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralTypeSeeder extends Seeder
{
    public function run(): void
    {
        $referralTypeNames = [
            'برای بررسی',
            'برای اقدام',
            'برای اطلاع',
            'برای ارائه گزارش',
            'برای همکاری'
        ];

        foreach ($referralTypeNames as $name) ReferralType::create(['name' => $name]);
    }
}
