<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostMazController;
use App\Http\Controllers\CommentMazController;
use App\Http\Controllers\LikeMazController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {

    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Post
    Route::get('/posts', [PostController::class, 'index']); // all posts
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{id}', [PostController::class, 'update']); // update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    // Like
    Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post

    //----------- Mazads -----------

    // PostMazads
    Route::get('/postsMazad', [PostMazController::class, 'index']); // all posts
    Route::post('/postsMazad', [PostMazController::class, 'store']); // create post
    Route::get('/postsMazad/{id}', [PostMazController::class, 'show']); // get single post
    Route::put('/postsMazad/{id}', [PostMazController::class, 'update']); // update post
    Route::delete('/postsMazad/{id}', [PostMazController::class, 'destroy']); // delete post

    // CommentMazads
    Route::get('/postsMazad/{id}/commentsMazad', [CommentMazController::class, 'index']); // all comments of a post
    Route::post('/postsMazad/{id}/commentsMazad', [CommentMazController::class, 'store']); // create comment on a post
    Route::put('/commentsMazad/{id}', [CommentMazController::class, 'update']); // update a comment
    Route::delete('/commentsMazad/{id}', [CommentMazController::class, 'destroy']); // delete a comment

    // LikeMazads
    Route::post('/postsMazad/{id}/likesMazad', [LikeMazController::class, 'likeOrUnlike']); // like or dislike back a post
});