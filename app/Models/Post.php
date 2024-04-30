<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
