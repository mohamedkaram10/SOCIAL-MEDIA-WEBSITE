<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', HomeController::class)
->middleware(['auth', 'verified'])
->name('home');

Route::get('/u/{user:username}', [ProfileController::class, 'index'])
->name('profile');

Route::middleware('auth')->group(function () {
    Route::post('/profile/update-images', [ProfileController::class, 'updateImage'])
        ->name('profile.updateImages');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/post', [PostController::class, 'store'])
        ->name('post.create');

Route::put('/post/{post}', [PostController::class, 'update'])
->name('post.update');

Route::delete('/post/{post}', [PostController::class, 'destroy'])
->name('post.destroy');

Route::get('/post/download/{attachment}', [PostController::class, 'download'])
->name('post.download');

Route::post('/post/{post}/reaction', [PostController::class, 'postReaction'])
    ->name('post.reaction');

Route::post('/post/{post}/comment', [PostController::class, 'createComment'])
    ->name('post.comment.create');

Route::delete('comment/{comment}', [PostController::class, 'deleteComment'])
    ->name('post.comment.delete');

Route::put('/comment/{comment}', [PostController::class, 'updateComment'])
    ->name('post.comment.update');

// Route::apiResource('/posts', PostController::class)->only(['update', 'destroy', 'store']);

require __DIR__.'/auth.php';
