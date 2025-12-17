<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController  extends Controller
{



    // POST - فقط admin
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'body'             => 'required|string',
            'image'            => 'nullable|image|max:2048',
            'published'        => 'boolean',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_ids'     => 'nullable|array',
            'category_ids.*'   => 'exists:post_categories,id',
        ]);

        $data['slug'] = Str::slug($data['title']);

        $data['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        $post->categories()->sync($data['category_ids'] ?? []);


        return response()->json($post->load('categories'), 201);
    }

    // PUT - فقط admin
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'title'            => 'sometimes|required|string|max:255',
            'body'             => 'sometimes|required|string',
            'image'            => 'nullable|image|max:2048',
            'published'        => 'boolean',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_ids'     => 'nullable|array',
            'category_ids.*'   => 'exists:post_categories,id',
        ]);

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        if (array_key_exists('category_ids', $data)) {
            $post->categories()->sync($data['category_ids'] ?? []);
        }

        return response()->json($post->load('categories'), 201);
    }

    // DELETE - فقط admin
    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post soft deleted']);
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $this->authorize('restore', $post);

        $post->restore();

        return response()->json(['message' => 'Post restored']);
    }
}
