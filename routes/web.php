<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Fruitcake\LaravelDebugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = [];
    if (Auth::check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    // Debugbar::info("hiiiiii", $posts);
    return view('home', ['posts' => $posts]);
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
