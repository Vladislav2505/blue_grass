<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nomination extends Model
{
    use HasFactory;

    protected $table = 'nominations';

    // Relations
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class,
            'event_nominations', 'nomination_id', 'event_id');
    }
}
