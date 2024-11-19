<?php

namespace Database\Factories\membership;

use App\Models\membership\Organization;
use App\Models\membership\ReferralType;
use App\Models\membership\Ticket;
use App\Models\membership\TicketStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketActionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'referral_order' => fake()->sentence(),
            'description_action' => fake()->paragraph(),
            'progress_percentage' => fake()->numberBetween(0, 100),
            'status' => fake()->boolean,
            'referral_type_id' => ReferralType::inRandomOrder()->value('id'),
            'referrer_id' => User::inRandomOrder()->value('id'),
            'organization_id' => Organization::inRandomOrder()->value('id'),
            'referral_recipient_id' => User::inRandomOrder()->value('id'),
            'action_status_id' => TicketStatus::inRandomOrder()->value('id'),
            'ticket_id' => Ticket::inRandomOrder()->value('id'),
        ];
    }
}
