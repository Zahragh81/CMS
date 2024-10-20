<?php

namespace App\Console;

use App\Jobs\SendSmsNotification;
use App\Models\membership\Meeting;
use App\Models\membership\SmsNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//        $schedule->call(function (){
//            $meetings = Meeting::where('notification', true)
//                ->where('start_time', '>', now())
//                ->where('start_time', '<=', now()->addHours(2))
//                ->get();
//
//            foreach ($meetings as $meeting){
//                SendSmsNotification::dispatch($meeting);
//            }
//        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
