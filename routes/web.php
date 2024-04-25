<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/posts',[PostController::class ,'index']);
// Route::get('/posts/create', [PostController::class , 'create']);
// Route::post('/posts' ,  [PostController::class , 'store']);
// Route::get('/posts/{id}' ,[PostController::class , 'show']);
// Route::get('/posts/{id}/edit' ,[PostController::class , 'edit']);
// Route::put('/posts/{id}',[PostController::class , 'update']);
// Route::delete('/posts/{id}',[PostController::class , 'destroy']);

Route::resource('posts', PostController::class)->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/github', [AuthController::class, 'redirectToGitHub']);
Route::get('/auth/github/callback', [AuthController::class, 'handleGitHubCallback']);