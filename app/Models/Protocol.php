<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'protocols';

    protected $fillable = [
        'name',
        'slug',
        'date',
        'file',
        'is_downloadable',
        'is_active',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::bootSlug();
    }
}
