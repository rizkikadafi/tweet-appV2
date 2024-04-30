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

    // public function followers()
    // {
    //     $followers = User::join('friendships', 'users.id', '=', 'friendships.user_id')
    //         ->where('friendships.friend_id', $this->id)
    //         ->select('users.*');

    //     $followers = User::join('friendships', 'users.id', '=', 'friendships.friend_id')
    //         ->where('friendships.user_id', $this->id)
    //         ->where('friendships.status', 'accepted')
    //         ->select('users.*')
    //         ->union($followers)
    //         ->get();

    //     return $followers;
    // }

    // public function following()
    // {
    //     $following = User::join('friendships', 'users.id', '=', 'friendships.friend_id')
    //         ->where('friendships.user_id', $this->id)
    //         ->select('users.*');

    //     $following = User::join('friendships', 'users.id', '=', 'friendships.user_id')
    //         ->where('friendships.friend_id', $this->id)
    //         ->where('friendships.status', 'accepted')
    //         ->select('users.*')
    //         ->union($following)
    //         ->get();

    //     return $following;
    // }

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

    // public function friends()
    // {

    //     $friends = User::join('friendships', 'users.id', '=', 'friendships.friend_id')
    //         ->where('friendships.user_id', $this->id)
    //         ->where('friendships.status', 'accepted')
    //         ->select('users.*');

    //     $friends = User::join('friendships', 'users.id', '=', 'friendships.user_id')
    //         ->where('friendships.friend_id', $this->id)
    //         ->where('friendships.status', 'accepted')
    //         ->select('users.*')
    //         ->union($friends)
    //         ->get();

    //     return $friends;
    // }

    public function pendingFriends(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Friendship::class, 'user_id', 'id', 'id', 'friend_id')
            ->where('friendships.status', 'pending');
    }
}
