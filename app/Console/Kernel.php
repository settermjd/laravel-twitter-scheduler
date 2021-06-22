<?php

namespace App\Console;

use App\Models\ManageTweetSchedule;
use App\Service\Tweet;
use Atymic\Twitter\Facade\Twitter;
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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function (Twitter $twitter) {
            $tweets = ManageTweetSchedule::where(
                [
                    'sent' => false,
                    'tweet_at' => (new \DateTime())->format('y-m-d H:i')
                ]
            )->get();
            $tweeter = new Tweet();
            $tweeter->send(Twitter::getFacadeRoot(), $tweets);
        })->everyMinute();
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
