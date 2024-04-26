<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeletedNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
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
        $email = config('site.email') ?? '';

        return (new MailMessage)
            ->subject('Ваша учетная запись была удалена администратором.')
            ->greeting('Здравствуйте!')
            ->line('Вы получили это письмо, поскольку учетная запись, связанная с этой почтой была удалена.')
            ->line("Если у вас есть какие-то вопросы, вы можете написать нам: $email");
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
