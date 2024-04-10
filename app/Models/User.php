<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin'
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

    /**
     * Отправить пользователю уведомление о сбросе пароля.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', compact('token'));
        $this->notify(new ResetPasswordNotification($url));
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->last_name . ' ' . $this->first_name . ' ' . $this->patronymic);
    }

}
