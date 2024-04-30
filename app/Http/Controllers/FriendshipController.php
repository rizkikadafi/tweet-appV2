<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function create(Request $request, User $user)
    {
        $friendship = new Friendship();
        $friendship->user_id = auth()->id();
        $friendship->friend_id = $user->id;
        $friendship->status = 'pending';
        $friendship->save();

        return redirect()->back()->with('success', 'Friend request sent.');
    }
}
