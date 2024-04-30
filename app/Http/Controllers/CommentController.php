<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.comment', [
            'post' => $post,
        ]);
    }

    public function create(Post $post, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:1000',
        ]);

        $data['user_id'] = Auth::id();
        $data['post_id'] = $post->id;

        Comment::create($data);

        return redirect('/posts/' . $post->id);
    }
}
