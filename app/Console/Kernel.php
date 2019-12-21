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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->command('inspire')
            ->hourly();*/

        // $schedule->command('backup:clean -n')->everyMinute()->appendOutputTo(storage_path('app') . '/backuplog/deletebackup.log'); //->daily()->at('02:00');
        //$schedule->command('backup:run -n')->everyMinute()->appendOutputTo(storage_path('app') . '/backuplog/runbackup.log'); //->daily()->at('03:00');
        $schedule->command('backup:clean -n')
            ->appendOutputTo(storage_path('app') . '/backuplog/deletebackup.log'); //
        $schedule->command('backup:run -n')
            ->appendOutputTo(storage_path('app') . '/backuplog/runbackup.log'); //;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
