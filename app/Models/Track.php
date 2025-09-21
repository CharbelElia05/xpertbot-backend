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
        'instructor_id', // The admin setting the instructor
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
}