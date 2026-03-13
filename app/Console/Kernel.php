<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register your custom commands here.
     */
    protected $commands = [
        \App\Console\Commands\CreateDatabase::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Schedule jobs here
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
