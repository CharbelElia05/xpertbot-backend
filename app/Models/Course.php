<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $fillable = [
        'track_id',
        'title',
        'content_type',
        'content_url',
        'order_number',
    ];
    // A course belongs to one track
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
    
}
