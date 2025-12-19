<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\public\PostController as PostControllerPublic;

use Illuminate\Support\Facades\Auth;
// php artisan vendor:publish --tag=laravel-pagination

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('home');
    Route::get('/posts', [PostControllerPublic::class, 'index'])->name('posts.index');
    Route::get('/posts/create', function () {
        return view('admin.post.post-create');
    })->name('posts.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::get('/post-categories', function () {
        return view('admin.dashboard');
    })->name('posts.categories.index');
});

Route::get('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');
