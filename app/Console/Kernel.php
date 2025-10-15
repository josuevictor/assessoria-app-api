<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\AtualizarRankingSemanalJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->job(new AtualizarRankingSemanalJob)->weeklyOn(1, '00:00'); // Roda toda segunda-feira à meia-noite
        $schedule->job(new AtualizarRankingSemanalJob)->everyMinute(); // Para testes, roda a cada minuto

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
