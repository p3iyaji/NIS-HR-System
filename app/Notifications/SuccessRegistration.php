<?php

namespace App\Notifications;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessRegistration extends Notification implements ShouldQueue
{
    use Queueable;
    protected $recipient;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $recipient)
    {
        $this->recipient = $recipient;
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
            ->subject('Success Registration Notification')
            ->greeting('Hello ' . $this->recipient->first_name . ' '. $this->recipient->first_name . '!')
            ->line('You have successfully registered to the Monis Platform @ ' . Carbon::now());
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'subject' => 'Login Successful',
            'content' => 'You have successfully registered to the Cooperative Accounting System @ ' . Carbon::now(),
            'user_id' => $notifiable->id,
            'type' => 'success_registration',
        ]);
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
