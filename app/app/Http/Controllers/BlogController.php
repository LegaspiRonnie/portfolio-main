<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;

class BlogController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $posts = Post::published()->orderByDesc('published_at')->paginate(6);

        return view('blog.index', compact('profile', 'posts'));
    }

    public function show(Post $post)
    {
        $profile = Profile::first();
        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(2)
            ->get();

        return view('blog.show', compact('profile', 'post', 'related'));
    }
}
