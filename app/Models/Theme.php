<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'themes';

    // Relations
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
