<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(static function ($notifiable, string $url) {

            if (Str::contains($url, 'http://localhost')) {
                $url = (string) Str::replace('http://localhost', config('app.url'), $url);
            }

            return (new MailMessage)
                ->subject('Подтверждение адреса электронной почты')
                ->greeting('Здравствуйте!')
                ->line('Пожалуйста, нажмите кнопку ниже, чтобы подтвердить свой адрес электронной почты.')
                ->action('Подтвердить', url($url))
                ->line('Если вы не создавали учетную запись, никаких дальнейших действий не требуется.');
        });
    }
}
