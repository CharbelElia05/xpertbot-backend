<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_text',
        'is_correct',
    ];

    protected $casts = [
        'question_id' => 'integer',
        'is_correct' => 'boolean',
    ];

    // Each option belongs to a question
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    // ✅ ADDED: Simple check if this option is correct
    public function isCorrect(): bool
    {
        return $this->is_correct;
    }

    // ✅ ADDED: Simple scope to get correct options
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    // ✅ ADDED: Simple scope to get incorrect options
    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }
}