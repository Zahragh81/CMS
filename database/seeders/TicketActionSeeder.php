<?php

namespace Database\Seeders;

use App\Models\membership\TicketAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketActionSeeder extends Seeder
{
    public function run(): void
    {
        $ticketActions = [
            [
                'referral_order' => 'باید سریعا بررسی بشه',
                'description_action' => 'این دستور نیاز به بررسی بیشتر دارد',
                'progress_percentage' => 15,
                'referral_type_id' => 1,
                'referrer_id' => 1,
                'organization_id' => 1,
                'referral_recipient_id' => 2,
                'action_status_id' => 1,
                'ticket_id' => 1,
            ]
        ];

        foreach ($ticketActions as $ticketAction) TicketAction::create($ticketAction);
    }
}
