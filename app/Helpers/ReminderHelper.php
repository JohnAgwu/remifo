<?php


namespace App\Helpers;


use App\Models\Reminder;
use Carbon\Carbon;

class ReminderHelper
{
    /**
     * Mark a reminder as completed
     */
    public static function markAsDone(): void
    {
        Reminder::isFrequency()->notDone()->each(function (Reminder $reminder) {
            if ($reminder->frequency <= $reminder->total_sent) {
                $reminder->is_done = true;
                $reminder->save();
            }
        });
    }

    /**
     * generate the start and end dates of a reminder to be created
     *
     * @param string|null $date
     * @param string $interval
     * @param int|null $frequency
     * @return array
     */
    public static function setDate(string|null $date, string $interval, int|null $frequency): array
    {
        $data['start_date'] = !is_null($date) ? Carbon::createFromFormat('Y-m-d\TH:i', $date) : now();

        if (!is_null($frequency)) {
            $data['end_date'] = match ($interval) {
                'DAILY' => $data['start_date']->copy()->addDays($frequency),
                'WEEKLY' => $data['start_date']->copy()->addWeeks($frequency),
                'MONTHLY' => $data['start_date']->copy()->addMonths($frequency),
                'QUARTER' => $data['start_date']->copy()->addQuarters($frequency),
                default => $data['start_date']->copy()->addYears($frequency),
            };
        }

        return $data;
    }
}
