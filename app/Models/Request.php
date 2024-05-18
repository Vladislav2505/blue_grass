<?php

namespace App\Models;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'team_name',
        'supervisor_full_name',
        'organization_name',
        'date_creation_team',
        'participants_number',
    ];

    protected $casts = [
        'status' => RequestStatus::class,
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
