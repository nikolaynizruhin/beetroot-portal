<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * The password.
     *
     * @var string
     */
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param  string  $password
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Welcome Notification')
                    ->line('Welcome to the Beetroot Family Portal!')
                    ->line('**Email:** '.$notifiable->email)
                    ->line('**Password:** '.$this->password)
                    ->action('Let\'s roll!', url('/'))
                    ->line('We are glad that you became a member of our family.');
    }
}
