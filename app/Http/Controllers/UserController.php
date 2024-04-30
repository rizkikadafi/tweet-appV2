<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user)
    {
        $authUser = Auth::user();
        // $status = Friendship::select('status')->where('user_id', $authUser->id)->where('friend_id', $user->id)->first();
        // $action_status = null;

        // if (!$status) {
        //     $status = Friendship::select('status')->where('friend_id', $authUser->id)->where('user_id', $user->id)->first();
        //     if (!$status) {
        //         $action_status = null;
        //     } else {
        //         $action_status = 'second';
        //     }
        // } else {
        //     $action_status = 'first';
        // }

        $status = null;
        if ($authUser->friends->contains($user)) {
            $status = 'friends';
        } elseif ($authUser->following->contains($user)) {
            $status = 'following';
        } elseif ($authUser->followers->contains($user)) {
            $status = 'followers';
        }

        return view('profile.index', [
            'user' => $authUser,
            'friend' => $user,
            'status' => $status ?? null,
        ]);
    }

    public function showFriends(User $user)
    {
        return view('friends.index', [
            'user' => $user,
            'friends' => $user->friends,
            'following' => $user->following,
            'followers' => $user->followers,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::where('username', 'like', "%$keyword%")
            ->orWhere('name', 'like', "%$keyword%")
            ->get();

        return response()->json(['users' => $users]);
    }

    public function follow(User $user)
    {
        $authUser = Auth::user();

        Friendship::create([
            'user_id' => $authUser->id,
            'friend_id' => $user->id,
        ]);

        return response()->json(['message' => 'Friend request sent']);
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();
        Friendship::where('user_id', $authUser->id)
            ->where('friend_id', $user->id)->delete();

        // Friendship::where('user_id', $authUser->id)
        //     ->where('friend_id', $user->id)->orWhere(function ($query) use ($user, $authUser) {
        //         $query->where('user_id', $user->id)->where('friend_id', $authUser->id);
        //     })->update(['status' => 'pending']);

        return response()->json(['message' => 'Unfollowed']);
    }

    // public function accept(User $user)
    // {
    //     $authUser = Auth::user();

    //     Friendship::where('user_id', $user->id)
    //         ->where('friend_id', $authUser->id)
    //         ->update(['status' => 'accepted']);

    //     return response()->json(['message' => 'Friend request accepted']);
    // }
}
