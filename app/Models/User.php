<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    // Role constants
    const ROLE_STUDENT = 'student';
    const ROLE_INSTRUCTOR = 'instructor';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user (as instructor) can create many tracks
    public function instructorTracks(): HasMany
    {
        return $this->hasMany(Track::class, 'instructor_id');
    }

    // A user (student) can be enrolled in many tracks
    public function enrolledTracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'enrollments');
    }

    // A user can have progress in many courses
    public function courseProgress(): HasMany
    {
        return $this->hasMany(CourseProgress::class);
    }

    // A user can have many quiz attempts
    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // A user can earn many certificates
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    // Helper methods for role checking
    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isInstructor(): bool
    {
        return $this->role === self::ROLE_INSTRUCTOR;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Scope methods for easy querying
    public function scopeStudents($query)
    {
        return $query->where('role', self::ROLE_STUDENT);
    }

    public function scopeInstructors($query)
    {
        return $query->where('role', self::ROLE_INSTRUCTOR);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }
}