<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CBTInvitationSuccess extends Notification implements ShouldQueue
{
    use Queueable;
    protected $recipient;
    protected $cbt_date;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $recipient, $cbt_date)
    {
        $this->recipient = $recipient;
        $this->cbt_date = $cbt_date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('CBT Invitation')
                    ->greeting('Hello ' . $this->recipient->first_name . ' '. $this->recipient->first_name . '!')
                    ->line('You are invited for the Monis CBT test, which will take place on: ' . $this->cbt_date);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
