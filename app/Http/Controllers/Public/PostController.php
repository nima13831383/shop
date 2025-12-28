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

    public function index($page = 1)
    {
        $posts = Post::latest()->with(['author', 'categories'])->where('published',true) // eager loading
            ->paginate(4, ['*'], 'page', $page);
        return view('public.blog', compact('posts'));
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->firstOrFail();
        $this->authorize('viewAny', $post);
        abort_if(!$post->published, 404);

        // افزایش بازدید
        $post->increment('views');

        $post = $post->load(['author', 'categories', 'reviews']);
        return view('public.article', compact('post'));
    }
}
