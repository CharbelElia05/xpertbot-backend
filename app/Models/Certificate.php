<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'track_id',
        'quiz_attempt_id',
        'certificate_url',
        'issued_at',
    ];
}
