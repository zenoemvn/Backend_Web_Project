<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany trackEvents()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'aboutme',
        'image',
        'email',
        'password',
        'username',
        'birthday',

    ];

    public function trackEvents(): BelongsToMany
    {
        return $this->belongsToMany(TrackEvent::class, 'user_track_events')
                    ->withPivot('performance')
                    ->withTimestamps();
    }

    public function records()
{
    return $this->hasMany(EventRecord::class);
}

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
}
