<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
		'App\Console\Commands\test',
		'App\Console\Commands\tampilkanDosen',
		'App\Console\Commands\HapusPeminjamanTidakTerkonfirmasi',
		'App\Console\Commands\uploadBelumLengkap'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /* $schedule->command('pinjam:hapusTidakTerkonfirmasi') */
        /*          ->dailyAt('07:00'); */
        $schedule->command('pinjam:hapusTidakTerkonfirmasi')
					->dailyAt('23.59');
        $schedule->command('email:lengkapi')
					->dailyAt('09:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
