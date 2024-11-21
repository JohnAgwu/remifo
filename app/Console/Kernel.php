<?php

namespace App\Console;

use App\Helpers\ReminderHelper;
use App\Models\Reminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        Mark Done Reminders
        $schedule->call(fn() => ReminderHelper::markAsDone())->daily();

        // cron reminder
        $cron_reminders = Reminder::isCron()->notDone()->get();

        $cron_reminders->each(function(Reminder $reminder) use ($schedule) {
            $schedule->call(fn() => $reminder->send())->cron($reminder->cron);
        });

//        Basic reminders with intervals and frequencies
        $basic_reminders = Reminder::isFrequency()->notDone()->get();

        $basic_reminders->each(function (Reminder $reminder) use ($schedule) {
            if (now() >= $reminder->start_date) {
                switch ($reminder->interval) {
                    case 'DAILY':
                        $time = $reminder->start_date->format('H:i');

                        $schedule->call(fn() => $reminder->send())->dailyAt($time);
                        break;

                    case 'WEEKLY':
                        $time = $reminder->start_date->format('H:i');
                        $day = $reminder->start_date->format('N'); // (1 for Monday, 7 for Sunday)

                        $schedule->call(fn() => $reminder->send())->weeklyOn($day, $time);
                        break;

                    case 'MONTHLY':
                        $time = $reminder->start_date->format('H:i');
                        $day = $reminder->start_date->format('j'); // (1st to 31st)

                        $schedule->call(fn() => $reminder->send())->monthlyOn($day, $time);
                        break;

                    default:
                        $time = $reminder->start_date->format('H:i');
                        $day = $reminder->start_date->format('j'); // (1st to 31st)
                        $month = $reminder->start_date->format('n'); // (1 to 12)

                        $schedule->call(fn() => $reminder->send())->yearlyOn($month, $day, $time);
                        break;
                }
            }
        });

        // Run artisan queue:work every minute and stop if empty.
        $schedule->command('queue:work --tries=3 --stop-when-empty')->everyMinute();
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
