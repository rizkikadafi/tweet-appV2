<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return response()->json(['message' => 'Post liked']);
    }

    public function unlike(Post $post)
    {
        Like::where('user_id', auth()->id())
            ->where('post_id', $post->id)
            ->delete();

        return response()->json(['message' => 'Post unliked']);
    }
}
