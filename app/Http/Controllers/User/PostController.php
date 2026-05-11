<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Menampilkan semua artikel
     */
    public function index()
    {
        $posts = Post::with('category')
            ->latest()
            ->get();

        return view(
            'user.posts.index',
            compact('posts')
        );
    }

    /**
     * Menampilkan detail artikel
     */
    public function show($id)
    {
        // ARTIKEL UTAMA
        $article = Post::with('category')
            ->where('id_posts', $id)
            ->firstOrFail();

        // ARTIKEL TERKAIT
        $relatedPosts = Post::with('category')
            ->where('id_posts', '!=', $article->id_posts)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'user.detailArticle',
            compact('article', 'relatedPosts')
        );
    }
}