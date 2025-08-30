<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
     protected $fillable = [
        'user_id',
        'course_id',
        'completed_at',
    ];
}
