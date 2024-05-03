<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    $imageContent = file_get_contents($googleUser->getAvatar());
    Storage::put('images/avatar/' . $googleUser->getId() . '.png', $imageContent);
    // dd($googleUser);

    $user = User::UpdateOrCreate(
        ['google_id' => $googleUser->getId()],
        [
            'name' => $googleUser->getName(),
            'username' => explode('@', $googleUser->getEmail())[0],
            'email' => $googleUser->getEmail(),
            'password' => Hash::make($googleUser->getId()),
            'avatar' => 'images/avatar/' . $googleUser->getId() . '.png',
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]
    );

    Auth::login($user);

    return redirect('/');
});

Route::post('/search-user', [UserController::class, 'search']);
Route::post('/users/follow/{user}', [UserController::class, 'follow']);
Route::post('/users/unfollow/{user}', [UserController::class, 'unfollow']);
Route::post('/users/accept/{user}', [UserController::class, 'accept']);
Route::post('/users/edit/{user}', [UserController::class, 'edit']);
Route::post('/posts/like/{post}', [LikeController::class, 'like']);
Route::post('/posts/unlike/{post}', [LikeController::class, 'unlike']);

Route::get('/', [HomeController::class, 'show'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'show'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/{user:username}/posts', [PostController::class, 'show']);
Route::get('/{user:username}/posts/{post}', [PostController::class, 'showPost']);
Route::get('/posts/create', [PostController::class, 'showCreate']);
Route::post('/posts/create', [PostController::class, 'create']);

Route::get('/posts/reply/{post}', [PostController::class, 'showReply']);
Route::post('/posts/reply/{post}', [PostController::class, 'createReply']);

Route::get('/friends', function () {
    return redirect('/friends/' . auth()->user()->username);
})->middleware('auth');

Route::get('/friends/{user:username}', [UserController::class, 'showFriends']);
Route::get('/{user:username}', [UserController::class, 'show']);
