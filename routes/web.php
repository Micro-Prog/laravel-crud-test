<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Home page with posts
Route::get('/', function () {
    $posts = [];

    if (auth()->check()) {
        // Assuming "usersCoolPosts" is a method in User model to fetch posts for the user
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});

// Authentication routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Post creation route
Route::post('create-post', [PostController::class, 'createPost']);

// Show edit post form route
Route::get('edit-post/{post}', [PostController::class, 'showEditPost']);

// Update post route
Route::put('edit-post/{post}', [PostController::class, 'updatePost']); // Make sure this is PUT to handle updates

Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

