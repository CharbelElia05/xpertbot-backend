<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'instructor_id',
    ];

    protected $casts = [
        'instructor_id' => 'integer',
    ];

    // A track belongs to one instructor (a User)
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // A track has many courses
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    // A track has one final quiz
    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    // A track has many enrolled users (students) through the enrollments table
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    // A track has many certificates issued for it
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    // ✅ ADDED: Check if user is enrolled in this track
    public function isUserEnrolled($userId): bool
    {
        return $this->students()->where('user_id', $userId)->exists();
    }

    // ✅ ADDED: Get enrollment count
    public function getEnrollmentCountAttribute(): int
    {
        return $this->students()->count();
    }

    // ✅ ADDED: Check if track has a quiz
    public function hasQuiz(): bool
    {
        return $this->quiz !== null;
    }

    // ✅ ADDED: Get completed users count
    public function getCompletedUsersCount(): int
    {
        return $this->certificates()->count();
    }

    // ✅ ADDED: Check if user completed this track
    public function isCompletedByUser($userId): bool
    {
        return $this->certificates()->where('user_id', $userId)->exists();
    }

    // ✅ ADDED: Get user's certificate for this track
    public function getUserCertificate($userId)
    {
        return $this->certificates()->where('user_id', $userId)->first();
    }
}