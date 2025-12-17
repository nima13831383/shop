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
        return Post::where('published', true)
            ->latest()
            ->paginate(10);
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
