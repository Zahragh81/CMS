<?php

namespace Database\Seeders;

use App\Models\membership\Ticket;
use Illuminate\Database\Seeder;


class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $progressBar = $this->command->getOutput()->createProgressBar(1000);
        $progressBar->start();

        for ($i = 1; $i <= 1000; $i++) {
            Ticket::factory()->create();

            $progressBar->advance();
        }

        $progressBar->finish();
    }

}
