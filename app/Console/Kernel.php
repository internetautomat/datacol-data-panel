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
        Commands\Drop::class,
        //Commands\DummyCommand::class,
        //Commands\TestBgCommand::class,
        //\Exfriend\Overlapping\Commands\ScheduleClearCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule( Schedule $schedule )
    {
        $schedule->command( 'reminder:send' )
                 ->daily()
                 ->withoutOverlapping();
    }
}
