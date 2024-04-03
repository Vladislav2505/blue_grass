<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $url
    ) {
        //
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
            ->subject('Уведомление о сбросе пароля')
            ->greeting('Здравствуйте!')
            ->line('Вы получили это письмо, поскольку мы получили запрос на сброс пароля для вашей учетной записи.')
            ->action('Сбросить пароль', url($this->url))
            ->line('Срок действия этой ссылки для сброса пароля истекает через 60 минут.')
            ->line('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.');
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
