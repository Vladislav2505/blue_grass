<?php

namespace App\Notifications;

use App\Models\Question;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendQuestionAnswerNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Question $question,
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
            ->subject("Ответ на вопрос \"{$this->question->question_title}\"")
            ->greeting('Здравствуйте!')
            ->line('Администратор сайта ознакомился с вашим вопросом и постарался дать на него ответ')
            ->line('Ваш вопрос: '.$this->question->question_text)
            ->line('Ответ на ваш вопрос: '.$this->question->answer_text);
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
