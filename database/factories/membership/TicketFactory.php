<?php

namespace Database\Factories\membership;

use App\Models\membership\TicketGroup;
use App\Models\membership\TicketPriority;
use App\Models\membership\TicketStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => fake()->boolean(),
            'user_id' => User::inRandomOrder()->value('id'),
            'ticket_group_id' => TicketGroup::inRandomOrder()->value('id'),
            'ticket_priority_id' => TicketPriority::inRandomOrder()->value('id'),
            'ticket_status_id' => TicketStatus::inRandomOrder()->value('id')
        ];
    }
}
