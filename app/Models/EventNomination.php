<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNomination extends Model
{
    use HasFactory;

    protected $table = 'event_nomination';
    public $timestamps = false;
}
