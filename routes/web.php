<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/posts', function () {
        return view('admin.dashboard');
    })->name('posts.index');
    Route::get('/posts/create', function () {
        return view('admin.dashboard');
    })->name('posts.create');
    Route::get('/post-categories', function () {
        return view('admin.dashboard');
    })->name('posts.categories.index');
});
