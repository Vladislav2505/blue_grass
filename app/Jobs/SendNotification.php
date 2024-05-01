<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use InvalidArgumentException;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ?User $user;

    protected Notification $notification;

    protected ?string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Notification $notification, ?User $user = null, ?string $email = null)
    {
        if ($user === null && $email === null) {
            throw new InvalidArgumentException('At least one argument must be provided.');
        }

        $this->user = $user;
        $this->email = $email;
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->user) {
            $this->user->notify($this->notification);
        } else {
            NotificationFacade::route('mail', $this->email)
                ->notify($this->notification);
        }
    }
}
