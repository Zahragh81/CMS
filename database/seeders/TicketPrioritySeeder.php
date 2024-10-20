<?php

namespace Database\Seeders;

use App\Models\membership\TicketPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    public function run(): void
    {
        $ticketPriorityNames = [
            'پایین',
            'متوسط',
            'بالا'
        ];

        foreach ($ticketPriorityNames as $name) TicketPriority::create(['name' => $name]);
    }
}
