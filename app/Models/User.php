<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserDeletedNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;
use Throwable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
    ];

    protected $guarded = [
        'is_admin',
    ];

    protected $appends = ['full_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin === 1;
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @throws Throwable
     */
    public function deleteWithNotification(): void
    {
        try {
            SendEmail::dispatchSync($this, new UserDeletedNotification());
        } catch (UnexpectedResponseException $e) {
            Log::error($e->getMessage());
        }
        $this->deleteOrFail();
    }

    /**
     * Отправить пользователю уведомление о сбросе пароля.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', compact('token'));
        SendEmail::dispatch($this, new ResetPasswordNotification($url));
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->last_name.' '.$this->first_name.' '.$this->patronymic);
    }
}
