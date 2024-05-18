<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'date_of',
        'image',
        'file',
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
        'description' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::bootSlug();
    }

    public function getNominationNamesStringAttribute(): string
    {
        return $this->nominations
            ->pluck('name')
            ->implode(', ');
    }

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

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
