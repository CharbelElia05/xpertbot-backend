<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'title',
        'description',
        'content_type',
        'content_url',
        'order_number',
        'duration',
    ];

    // Relationships
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function courseProgress(): HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }
}
