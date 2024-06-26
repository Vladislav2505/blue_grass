<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nomination extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'nominations';

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::bootSlug();
    }

    // Relations
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class,
            'event_nomination', 'nomination_id', 'event_id');
    }
}
