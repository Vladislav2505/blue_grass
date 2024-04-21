<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function bootSlug(): void
    {
        static::creating(static function ($model) {
            if (empty($model->slug) && ! is_null($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
