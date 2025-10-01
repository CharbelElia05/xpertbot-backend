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
        'description',     // ✅ ADDED
        'content_type',
        'content_url',
        'order_number',
        'duration',        // ✅ ADDED
    ];

    protected $casts = [
        'order_number' => 'integer',
        'duration' => 'integer', // ✅ ADDED
    ];

    // A course belongs to one track
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    // ✅ ADDED: A course can have many progress records
    public function courseProgress(): HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }

    // ✅ ADDED: Get users who completed this course
    public function completedUsers()
    {
        return $this->belongsToMany(User::class, 'course_progress')
                    ->wherePivot('completed_at', '!=', null)
                    ->withTimestamps();
    }

    // ✅ ADDED: Helper method to check completion
    public function isCompletedByUser($userId): bool
    {
        return $this->courseProgress()
                    ->where('user_id', $userId)
                    ->whereNotNull('completed_at')
                    ->exists();
    }
}