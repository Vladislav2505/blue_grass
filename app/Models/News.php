<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'news';

    protected $fillable = [
        'name',
        'image',
        'description',
        'is_active',
    ];

    protected $casts = [
        'updated_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::bootSlug();
    }
}
