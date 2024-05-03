<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public static function generate_username()
    {
        $last_user = User::latest()->first();
        $last_id = ($last_user !== null) ? $last_user->id : 0;
        $randomNumber = mt_rand(1000, 9999);
        $username = "user" . $randomNumber . ($last_id + 1);
        return $username;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function friendships(): HasMany
    {
        return $this->hasMany(Friendship::class);
    }


    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id');
    }

    public function friends(): BelongsToMany
    {
        return $this->following()->whereHas('friendships', function ($query) {
            $query->where('friend_id', $this->id);
        });
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function hasLikedPost(Post $post): bool
    {
        return $this->likedPosts->contains($post);
    }
}
