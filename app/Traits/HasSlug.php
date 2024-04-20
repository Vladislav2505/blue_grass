<?php

namespace App\Traits;

trait HasSlug
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
