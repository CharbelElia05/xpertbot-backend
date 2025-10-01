<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
    ];

    protected $casts = [
        'quiz_id' => 'integer',
    ];

    // Each question belongs to a quiz
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    // Each question has many options
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    // ✅ ADDED: Get the correct option for this question
    public function correctOption()
    {
        return $this->options()->where('is_correct', true)->first();
    }

    // ✅ ADDED: Check if an option is correct
    public function isOptionCorrect($optionId): bool
    {
        $option = $this->options()->where('id', $optionId)->first();
        return $option && $option->is_correct;
    }

    // ✅ ADDED: Get all correct options (for multiple correct answers)
    public function correctOptions()
    {
        return $this->options()->where('is_correct', true)->get();
    }

    // ✅ ADDED: Check if user's answer is correct
    public function isUserAnswerCorrect($userSelectedOptionId): bool
    {
        return $this->isOptionCorrect($userSelectedOptionId);
    }

    // ✅ ADDED: Scope for questions with options
    public function scopeWithOptions($query)
    {
        return $query->with('options');
    }

    // ✅ ADDED: Get question type (single/multiple choice based on correct options count)
    public function getQuestionTypeAttribute(): string
    {
        $correctCount = $this->options()->where('is_correct', true)->count();
        return $correctCount > 1 ? 'multiple' : 'single';
    }
}