<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'partners';

    protected $fillable = [
        'name',
        'image',
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
}
