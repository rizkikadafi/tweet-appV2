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
        // dd($user->avatar);
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

        return response()->json(['message' => 'Unfollowed']);
    }

    public function edit(User $user, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'bio' => 'max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->username !== $user->username) {
            $request->validate([
                'username' => 'required|unique:users|max:100',
            ]);
        }

        if ($request->file('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('images/avatar');
        } else {
            $data['avatar'] = $user->avatar;
        }

        $user->update($data);

        return redirect("/" . $request->username);
    }
}
