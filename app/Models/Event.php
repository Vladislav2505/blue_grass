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

    protected $fillable = [
        'name',
        'date_of',
        'image',
        'award',
        'description',
        'request_access',
        'is_active',
        'theme_id',
        'location_id',
    ];

    protected $casts = [
        'date_of' => 'datetime:Y-m-d H:i',
        'request_access' => 'boolean',
        'is_active' => 'boolean',
        'description' => 'json',
    ];

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
            'event_nomination', 'event_id', 'nomination_id');
    }
}
