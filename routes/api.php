<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Comment\CommentController;
use App\Http\Controllers\API\Post\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('post', PostController::class);
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comment-store', [CommentController::class, 'store']);
});


