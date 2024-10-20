<?php

namespace Database\Seeders;

use App\Models\membership\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    public function run(): void
    {
        $ticketStatusNames = [
            'جدید',
            'پذیرش شده',
            'در حال انجام',
            'انجام شده',
            'رد شده'
        ];

        foreach ($ticketStatusNames as $name) TicketStatus::create(['name' => $name]);
    }
}
