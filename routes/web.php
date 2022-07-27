<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home']);
Route::get('home', [PageController::class, 'home']);
Route::get('dashboard', [PageController::class, 'dashboard']);
Route::get('login', [PageController::class, 'login'])->middleware('guest');
Route::get('register', [PageController::class, 'register'])->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('posts', [PostController::class, 'publish'])->name('publish');
Route::post('deletepost', [PostController::class, 'delete'])->name('deletepost');
Route::post('post/like', [LikeController::class, 'like'])->name('post/like');
Route::post('post/unlike', [LikeController::class, 'unlike'])->name('post/unlike');
Route::get('user/{id}', [UserController::class, 'user'])->name('user');
