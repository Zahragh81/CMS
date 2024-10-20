<?php

namespace Database\Seeders;

use App\Models\membership\TicketGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketGroupSeeder extends Seeder
{
    public function run(): void
    {
        $ticketGroupNames = [
            'اعلام خرابی سیستم',
            'درخواست راهنمایی',
            'درخواست اصلاح مشخصات در سامانه',
            'درخواست پیگیری مرسوله'
        ];

        foreach ($ticketGroupNames as $name) TicketGroup::create(['name' => $name]);
    }
}
