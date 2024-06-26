<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('home.index', [
            'posts' => Post::with('user')->whereNull('parent_id')->latest()->get(),
        ]);
    }
}
