<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/search-user', [UserController::class, 'search']);
Route::post('/users/follow/{user}', [UserController::class, 'follow']);
Route::post('/users/unfollow/{user}', [UserController::class, 'unfollow']);
Route::post('/users/accept/{user}', [UserController::class, 'accept']);

Route::get('/', [HomeController::class, 'show'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'show'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/posts', [PostController::class, 'show']);
Route::get('/posts/create', [PostController::class, 'showCreate']);
Route::post('/posts/create', [PostController::class, 'create']);

Route::get('/posts/reply/{post}', [PostController::class, 'showReply']);
Route::post('/posts/reply/{post}', [PostController::class, 'createReply']);
Route::get('/posts/{post}', [PostController::class, 'showPost']);

Route::get('/friends', function () {
    return redirect('/friends/' . auth()->user()->username);
})->middleware('auth');

Route::get('/friends/{user:username}', [UserController::class, 'showFriends']);
Route::get('/{user:username}', [UserController::class, 'show']);
