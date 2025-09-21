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
}