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
        Commands\DeleteOldUserSessions::class, //แก้ไขบรรนี้เพื่อ class command ที่เราได้สร้างขึ้น, กรณีเรามีการสร้าง command หลายๆ command เราก็มาใส่เรียงต่อๆ
        Commands\DeleteOldPasswordResetTokens::class,
    ];


    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('sessions:delete')->everyMinute();
        $schedule->command('tokens:delete')->everyMinute();
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
