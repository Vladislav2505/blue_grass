<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'collections';

    protected $fillable = [
        'name',
        'images',
        'is_active',
    ];

    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'images' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::bootSlug();
    }
}
