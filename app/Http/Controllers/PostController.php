<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show()
    {
        return view('posts.index', [
            'posts' => Post::where('user_id', Auth::id())->latest()->get(),
        ]);
    }

    public function showCreate()
    {
        return view('posts.create');
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:1000',
        ]);

        $data['user_id'] = Auth::id();

        Post::create($data);

        return redirect('/');
    }

    public function showPost(Post $post)
    {
        return view('posts.threads', [
            'post' => $post,
            'children' => $post->where('parent_id', $post->id)->latest()->get()
        ]);
    }

    public function showReply(Post $post)
    {
        return view('posts.reply', [
            'post' => $post,
        ]);
    }

    public function createReply(Post $post, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:1000',
        ]);

        $data['user_id'] = Auth::id();
        $data['parent_id'] = $post->id;

        Post::create($data);

        return redirect('/posts/' . $post->id);
    }

    // public function showComments(Post $post)
    // {
    //     return view('posts.comment', [
    //         'post' => $post,
    //     ]);
    // }
}
