<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    // Relations
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function nominations(): BelongsToMany
    {
        return $this->belongsToMany(Nomination::class,
            'event_nominations', 'event_id', 'nomination_id');
    }
}
