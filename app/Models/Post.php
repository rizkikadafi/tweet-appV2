<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function getNestedParentsAttribute()
    {
        $parents = [];
        $post = $this;

        while ($post->parent) {
            $parents[] = $post->parent;
            $post = $post->parent;
        }

        return collect($parents)->reverse();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function usersWhoLiked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function userWhoLiked(User $user): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->where('user_id', $user->id);
    }

    public function intervalTime(): string
    {
        $now = now();
        $diff = $this->created_at->diff($now);

        if ($diff->days > 0) {
            return $this->created_at->format('d M Y');
        }

        if ($diff->h > 0) {
            return $diff->h . 'h ago';
        }

        if ($diff->i > 0) {
            return $diff->i . 'm ago';
        }

        return $diff->s . 'just now';
    }
}
