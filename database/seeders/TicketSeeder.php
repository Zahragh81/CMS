<?php

namespace Database\Seeders;

use App\Models\membership\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'title' => 'لاگین نشدن',
                'description' => 'نمی توانم لاگین شوم',
                'user_id' => 1,
                'ticket_group_id' => 1,
                'ticket_priority_id' => 2,
                'ticket_status_id' => 1,
            ],
            [
                'title' => 'درگاه خرید',
                'description' => 'نمی توانم خرید انجام دهم.',
                'user_id' => 2,
                'ticket_group_id' => 2,
                'ticket_priority_id' => 1,
                'ticket_status_id' => 1,
            ],
            [
                'title' => 'ارسال پیامک',
                'description' => 'پیامک را دریافت نمیکنم',
                'user_id' => 3,
                'ticket_group_id' => 3,
                'ticket_priority_id' => 3,
                'ticket_status_id' => 1,
            ]
        ];

        foreach ($tickets as $ticket) Ticket::create($ticket);
    }
}
