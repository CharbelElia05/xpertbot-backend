<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'title',
        'passing_score',
    ];

    protected $casts = [
        'track_id' => 'integer',
        'passing_score' => 'integer',
    ];

    // Each quiz belongs to a track
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    // Each quiz has many questions
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // ✅ ADDED: Quiz has many attempts
    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // ✅ ADDED: Helper to check if user can attempt quiz
    public function canUserAttempt($userId): bool
    {
        $attemptCount = $this->quizAttempts()
                            ->where('user_id', $userId)
                            ->count();
        
        return $attemptCount === 0; // Allow only one attempt for now
    }

    // ✅ ADDED: Get latest attempt by user
    public function getUserAttempt($userId)
    {
        return $this->quizAttempts()
                    ->where('user_id', $userId)
                    ->latest()
                    ->first();
    }

    // ✅ ADDED: Check if user passed this quiz
    public function didUserPass($userId): bool
    {
        $attempt = $this->getUserAttempt($userId);
        return $attempt && $attempt->score >= $this->passing_score;
    }
}