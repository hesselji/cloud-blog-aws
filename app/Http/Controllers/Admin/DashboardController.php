<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY POSTS
        |--------------------------------------------------------------------------
        */

        $query = Post::with('category');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where('title', 'like', '%' . $request->search . '%');
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER CATEGORY
        |--------------------------------------------------------------------------
        */

        if ($request->category) {

            $query->where(
                'categories_id',
                $request->category
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | URUTKAN
        |--------------------------------------------------------------------------
        */

        if ($request->sort == 'oldest') {

            $query->orderBy('created_at', 'asc');

        } else {

            $query->latest();
        }

        /*
        |--------------------------------------------------------------------------
        | GET DATA
        |--------------------------------------------------------------------------
        */

        $posts = $query->get();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalPosts = Post::count();

        $publishedPosts = Post::where(
            'status',
            'published'
        )->count();

        $draftPosts = Post::where(
            'status',
            'draft'
        )->count();

        $totalComments = Comment::count();

        $categories = Category::all();

        return view('admin.posts.dashboard', compact(
            'posts',
            'categories',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'totalComments'
        ));
    }
}