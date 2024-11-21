<?php

namespace App\Notifications;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;


    protected Reminder $reminder;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param Reminder $reminder
     * @return MailMessage
     */
    public function toMail( $notifiable ): MailMessage
    {

        $loginUrl = route('login');
        $senderName = $this->reminder->user->name;
        $senderEmail = 'noreply@remifo.com';
        $body = $this->reminder->body;

        return (new MailMessage)
            ->subject($this->reminder->subject)
            ->from($senderEmail, $senderName)
            ->markdown('email.email_notification', [
                'body' => $body,
                'loginUrl' => $loginUrl
            ])
        ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
