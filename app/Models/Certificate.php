<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'track_id',
        'quiz_attempt_id',
        'certificate_url',
        'issued_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'track_id' => 'integer',
        'quiz_attempt_id' => 'integer',
        'issued_at' => 'datetime',
    ];

    // Certificate belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Certificate belongs to a track
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    // Certificate is linked to a quiz attempt
    public function quizAttempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class);
    }
}