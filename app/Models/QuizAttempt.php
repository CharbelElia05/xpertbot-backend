<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'quiz_id' => 'integer',
        'score' => 'integer',
    ];

    // Each attempt belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Each attempt belongs to a quiz
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}