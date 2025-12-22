<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\public\PostController as PostControllerPublic;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/create', function () {
        return view('admin.post.post-create');
    })->name('posts.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::delete('/posts/forcedelete/{post}', [PostController::class, 'forcedelete'])->name('posts.forcedelete');
    Route::get('/posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
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



Route::post('/ckeditor/upload', function (Request $request) {

    if (!$request->user()->hasRole('admin')) {
        abort(403);
    }

    $request->validate([
        'upload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    // $path = $request->file('upload')->store('ckeditor', 'public');
    if (!file_exists(public_path('posts/ckeditor'))) {
        mkdir(public_path('posts/ckeditor'), 0755, true);
    }
    if ($request->hasFile('upload')) {
        $file = $request->file('upload');

        // مسیر مقصد داخل public
        $destinationPath = public_path('posts/ckeditor'); // public/posts
        // نام فایل (می‌تونی timestamp یا uniqid بذاری)
        $filename = time() . '_' . $file->getClientOriginalName();

        // انتقال فایل به مسیر مقصد
        $file->move($destinationPath, $filename);

        // مسیر برای ذخیره در دیتابیس (relatvie to public)
        $path = 'posts/ckeditor/' . $filename;
    }
    return response()->json([
        'uploaded' => true,
        'url' => asset($path),
    ]);
})->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])
    ->name('ckeditor.upload');
