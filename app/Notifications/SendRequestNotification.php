<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendRequestNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Request $request,
    ) {
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
            ->subject('Пользователь оставил новую заявку на участие')
            ->greeting('Новая заявка')
            ->line('Мероприятие: '.$this->request->event->name)
            ->line('Email: '.$this->request->email)
            ->line('ФИО: '.$this->request->full_name)
            ->line('Телефон: '.$this->request->phone)
            ->line('Адрес: '.$this->request->address);
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
