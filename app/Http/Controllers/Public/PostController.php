<?php

namespace App\Http\Controllers\Public;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController  extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $posts = Post::latest()->with(['author','categories']) // eager loading
            ->paginate(10);
        return view('admin.post.post-index', compact('posts'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        abort_if(!$post->published, 404);

        // افزایش بازدید
        $post->increment('views');

        return $post->load(['author', 'categories', 'reviews']);
    }
}
