<?php

namespace Database\Seeders;

use App\Models\membership\TicketAction;
use Illuminate\Database\Seeder;


class TicketActionSeeder extends Seeder
{
    public function run(): void
    {
        $progressBar = $this->command->getOutput()->createProgressBar(7000);
        $progressBar->start();

        for ($i = 1; $i <= 7000; $i++) {
            TicketAction::factory()->create();

            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
