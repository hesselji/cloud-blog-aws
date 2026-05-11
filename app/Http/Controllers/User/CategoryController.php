<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where(
            'slug',
            $slug
        )->firstOrFail();

        $posts = Post::where(
                    'categories_id',
                    $category->id_categories
                )
                ->latest()
                ->get();

        return view('user.category', compact('category', 'posts'));
    }
}