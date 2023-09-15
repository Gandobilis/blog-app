<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/post', PostController::class)->names('post');
    Route::resource('/comment', CommentController::class)->names('comment')->only('store', 'update', 'destroy');

    Route::post('/posts/{post}/toggleLike', [PostController::class, 'toggleLike'])->name('posts.toggleLike');
    Route::post('/comments/{comment}/toggleLike', [CommentController::class, 'toggleLike'])->name('comments.toggleLike');
});

require __DIR__ . '/auth.php';
