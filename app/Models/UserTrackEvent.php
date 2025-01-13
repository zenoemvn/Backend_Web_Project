<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrackEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'track_event_id',
        'performance',
    ];
}
