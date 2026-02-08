<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\public\PostController as PostControllerPublic;
use App\Http\Controllers\public\CaptchaController;
use App\Http\Controllers\public\PostReviewController as PostReviewControllerPublic;
use App\Http\Controllers\Admin\PostReviewController;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Admin\MediaController;
use App\Models\MediaItem;
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
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/page/{page}', [PostController::class, 'index'])
        ->name('posts.page');
    Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/trash/page/{page}', [PostController::class, 'trashed'])
        ->name('posts.trashed.page');
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

    Route::get('/post-reviews/show/{review}', [PostReviewController::class, 'show'])
        ->name('reviews.show');

    Route::get('/post-reviews', [PostReviewController::class, 'index'])
        ->name('reviews.index');

    Route::get('/post-reviews/page/{page}', [PostReviewController::class, 'index'])
        ->name('reviews.page');
    Route::get('/post-reviews/edit/{review}', [PostReviewController::class, 'edit'])->name('reviews.edit');
    Route::post('/post-reviews/update/{review}', [PostReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/post-reviews/delete/{review}', [PostReviewController::class, 'destroy'])->name('reviews.delete');
    Route::delete('/post-reviews/forcedelete/{review}', [PostReviewController::class, 'forcedelete'])->name('reviews.forcedelete');
    Route::get('/post-reviews/restore/{review}', [PostReviewController::class, 'restore'])->name('reviews.restore');


    Route::get('/media/upload', fn() => view('admin.media.upload'))->name('media.upload');
    Route::post('/media/upload', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.delete');
    Route::get('/media/index', [MediaController::class, 'index'])->name('media.index');
    Route::post('/upload/photo', function (Request $request) {

        $user = $request->user();

        if (!$user || !$user->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // یک MediaItem برای نگه‌داری مدیا
        $item = MediaItem::firstOrCreate([
            'title' => 'froala-uploads'
        ]);

        $media = $item
            ->addMedia($request->file('file'))
            ->usingName(
                pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME)
            )
            ->usingFileName(
                time() . '_' . $request->file('file')->getClientOriginalName()
            )
            ->toMediaCollection('images'); // کالکشن مخصوص Froala

        return response()->json([
            'link' => $media->getFullUrl(), // چیزی که Froala می‌خواد
        ]);
    })->middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'role:admin',
    ])->name('upload.photo');

    Route::post('/upload/video', function (Request $request) {
        $user = $request->user();

        if (!$user || !$user->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|mimetypes:video/mp4,video/webm,video/ogg|max:51200', // 50MB
        ]);

        // یک MediaItem برای نگه‌داری مدیا
        $item = MediaItem::firstOrCreate([
            'title' => 'froala-uploads'
        ]);

        $media = $item
            ->addMedia($request->file('file'))
            ->usingName(
                pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME)
            )
            ->usingFileName(
                time() . '_' . $request->file('file')->getClientOriginalName()
            )
            ->toMediaCollection('videos'); // کالکشن مخصوص Froala

        return response()->json([
            'link' => $media->getFullUrl(), // چیزی که Froala می‌خواد
        ]);
    })->middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'role:admin'
    ])->name('upload.video');
});

Route::get('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');



// Route::post('/ckeditor/upload', function (Request $request) {

//     if (!$request->user()->hasRole('admin')) {
//         abort(403);
//     }

//     $request->validate([
//         'upload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
//     ]);

//     // $path = $request->file('upload')->store('ckeditor', 'public');
//     if (!file_exists(public_path('posts/ckeditor'))) {
//         mkdir(public_path('posts/ckeditor'), 0755, true);
//     }
//     if ($request->hasFile('upload')) {
//         $file = $request->file('upload');

//         // مسیر مقصد داخل public
//         $destinationPath = public_path('posts/ckeditor'); // public/posts
//         // نام فایل (می‌تونی timestamp یا uniqid بذاری)
//         $filename = time() . '_' . $file->getClientOriginalName();

//         // انتقال فایل به مسیر مقصد
//         $file->move($destinationPath, $filename);

//         // مسیر برای ذخیره در دیتابیس (relatvie to public)
//         $path = 'posts/ckeditor/' . $filename;
//     }
//     return response()->json([
//         'uploaded' => true,
//         'url' => asset($path),
//     ]);
// })->middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
//     'role:admin'
// ])
//     ->name('ckeditor.upload');




//public routes

Route::get('/blog', [PostControllerPublic::class, 'index'])->name('public.blog');
Route::get('/blog/page/{page}', [PostControllerPublic::class, 'index'])
    ->name('public.blog.page');
Route::get('/blog/{slug}', [PostControllerPublic::class, 'show'])->name('public.blog.article');
Route::get('test', function () {
    return view('test');
});


Route::get('/captcha/image', [CaptchaController::class, 'image'])->name('captcha.image');
Route::post('/post-reviews', [PostReviewControllerPublic::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('post.reviews.store');
