<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'track_id',
        'current_course_id',
        'enrolled_at',
        'completed_at',
    ];
}
