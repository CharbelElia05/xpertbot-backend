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

    // ✅ ADDED: Check if attempt passed
    public function getPassedAttribute(): bool
    {
        return $this->score >= $this->quiz->passing_score;
    }

    // ✅ ADDED: Calculate percentage score
    public function getPercentageAttribute(): float
    {
        $totalPoints = $this->quiz->questions->sum('points') ?: 1;
        return ($this->score / $totalPoints) * 100;
    }

    // ✅ ADDED: Check if this is the user's latest attempt
    public function isLatestAttempt(): bool
    {
        $latestAttempt = $this->user->quizAttempts()
            ->where('quiz_id', $this->quiz_id)
            ->latest()
            ->first();
            
        return $latestAttempt && $latestAttempt->id === $this->id;
    }

    // ✅ ADDED: Scope for passed attempts
    public function scopePassed($query)
    {
        return $query->whereHas('quiz', function($q) {
            $q->whereColumn('quiz_attempts.score', '>=', 'quizzes.passing_score');
        });
    }

    // ✅ ADDED: Scope for failed attempts
    public function scopeFailed($query)
    {
        return $query->whereHas('quiz', function($q) {
            $q->whereColumn('quiz_attempts.score', '<', 'quizzes.passing_score');
        });
    }
}