<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'full_name',
        'email',
        'question_title',
        'question_text',
        'user_id',
        'is_closed',
        'answer_text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
