<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'title',
        'passing_score',
    ];

    // Relationships
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'quiz_attempts', 'quiz_id', 'user_id');
    }
}
