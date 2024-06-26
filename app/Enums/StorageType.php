<?php

namespace App\Enums;

enum StorageType: string
{
    case Events = 'events';
    case Protocols = 'protocols';
    case Partners = 'partners';
    case Collections = 'collections';
    case News = 'news';
}
