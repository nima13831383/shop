<?php

namespace App\Http\Controllers\Admin;

use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController  extends Controller
{

    public function trashed($page = 1)
    {
        $posts = Post::onlyTrashed() // فقط پست‌های Soft Deleted
            ->latest()
            ->with(['author', 'categories'])
            ->paginate(10, ['*'], 'page', $page);

        return view('admin.post.post-trash', compact('posts'));
    }

    public function index($page = 1)
    {
        $posts = Post::latest()->with(['author', 'categories']) // eager loading
            ->paginate(4, ['*'], 'page', $page);
        return view('admin.post.post-index', compact('posts'));
    }
    // POST - فقط admin
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Post::class);
            DB::beginTransaction();

            $data = $request->validate([
                'title'            => 'required|string|max:255',
                'body'             => 'required|string',
                'description'             => 'required|string',
                'ttr' => 'integer',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'published'        => 'boolean',
                'meta_keywords'    => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'category_ids'     => 'nullable|array',
                'category_ids.*'   => 'exists:post_categories,id',
            ]);

            $data['slug'] = Str::slug($data['title']);
            $data['user_id'] = Auth::id();
            //$data['body'] = Purifier::clean($data['body']);
            // if ($request->hasFile('image')) {
            //     $data['image'] = $request->file('image')->store('posts', 'public');
            // }
            if (!file_exists(public_path('posts'))) {
                mkdir(public_path('posts'), 0755, true);
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // مسیر مقصد داخل public
                $destinationPath = public_path('posts'); // public/posts
                // نام فایل (می‌تونی timestamp یا uniqid بذاری)
                $filename = time() . '_' . $file->getClientOriginalName();

                // انتقال فایل به مسیر مقصد
                $file->move($destinationPath, $filename);

                // مسیر برای ذخیره در دیتابیس (relatvie to public)
                $data['image'] = 'posts/' . $filename;
            }



            $post = Post::create($data);
            $post->categories()->sync($data['category_ids'] ?? []);

            DB::commit();

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post created successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Post create failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'خطا در ایجاد پست' . $e]);
        }
    }
    public function edit(Post $post)
    {
        return view('admin.post.post-edit', compact('post'));
    }
    // PUT - فقط admin

    public function update(Request $request, Post $post)
    {
        try {
            $this->authorize('update', $post);

            DB::beginTransaction();
            $data = $request->validate([
                'title'            => 'sometimes|required|string|max:255',
                'body'             => 'sometimes|required|string',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'published'        => 'boolean',
                'meta_keywords'    => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'category_ids'     => 'nullable|array',
                'category_ids.*'   => 'exists:post_categories,id',
            ]);

            // اگر عنوان تغییر کرد → اسلاگ جدید
            if (isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            // $data['body'] = Purifier::clean($data['body']);

            // آپلود تصویر جدید
            // if ($request->hasFile('image')) {
            //     $data['image'] = $request->file('image')->store('posts', 'public');
            // }
            if (!file_exists(public_path('posts'))) {
                mkdir(public_path('posts'), 0755, true);
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // مسیر مقصد داخل public
                $destinationPath = public_path('posts'); // public/posts
                // نام فایل (می‌تونی timestamp یا uniqid بذاری)
                $filename = time() . '_' . $file->getClientOriginalName();

                // انتقال فایل به مسیر مقصد
                $file->move($destinationPath, $filename);

                // مسیر برای ذخیره در دیتابیس (relatvie to public)
                $data['image'] = 'posts/' . $filename;
            }

            // آپدیت پست
            $post->update($data);

            // سینک دسته‌بندی‌ها (اگر ارسال شده باشد)
            if (array_key_exists('category_ids', $data)) {
                $post->categories()->sync($data['category_ids'] ?? []);
            }

            DB::commit();

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post updated successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Post update failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'خطا در ویرایش پست' . $e]);
        }
    }

    // DELETE - فقط admin
    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post trashed successfully');
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $this->authorize('restore', $post);

        $post->restore();

        return redirect()
            ->route('admin.posts.trashed')
            ->with('success', 'Post restored successfully');
    }
    public function forcedelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $post);

        $post->forceDelete();

        return redirect()
            ->route('admin.posts.trashed')
            ->with('success', 'Post deleted successfully');
    }
}
