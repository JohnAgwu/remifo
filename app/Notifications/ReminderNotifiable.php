<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable;

class ReminderNotifiable
{

    use Notifiable;

    public function routeNotificationFor($notification)
    {
        return $this->email;
    }
}
