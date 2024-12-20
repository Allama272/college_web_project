<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,         // Related model
            'follows',    // Pivot table
            'follower_id',       // Foreign key of current model
            'following_id'        // Foreign key of related model
        )->withTimestamps();     // Add created_at/updated_at
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,         // Related model
            'follows',    // Pivot table
            'following_id',       // Foreign key of current model
            'follower_id'        // Foreign key of related model
        )->withTimestamps();
    }
    // Follow a user
    public function follow(User $user)
    {
        // Check if not already following
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user);
            return true;
        }
        return false;
    }

    // Unfollow a user
    public function unfollow(User $user)
    {
        $this->following()->detach($user);
    }

    // Check if following a specific user
    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    // Convenience attributes for follower/following counts
    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }




    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
