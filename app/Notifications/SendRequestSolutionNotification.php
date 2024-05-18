<?php

namespace App\Notifications;

use App\Enums\RequestStatus;
use App\Models\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendRequestSolutionNotification extends Notification
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
        if ($this->request->status === RequestStatus::Accepted) {
            return (new MailMessage)
                ->subject('Ваша заявка была принята')
                ->greeting('Здравствуйте!')
                ->line("Ваша заявка на участие в мероприятии \"{$this->request->event->name}\" была принята.");
        }

        return (new MailMessage)
            ->subject('Ваша заявка была отклонена')
            ->greeting('Здравствуйте!')
            ->line("Ваша заявка на участие в мероприятии \"{$this->request->event->name}\" была отклонена.");
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
