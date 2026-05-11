<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | HEADLINE
        |--------------------------------------------------------------------------
        */

       $headline = Post::where('status', 'published')
                ->latest()
                ->first();

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR POSTS
        |--------------------------------------------------------------------------
        */

        $sidebarPosts = Post::where('status', 'published')
                    ->latest()
                    ->skip(1)
                    ->take(4)
                    ->get();

        /*
        |--------------------------------------------------------------------------
        | LATEST POSTS
        |--------------------------------------------------------------------------
        */

       $latestPosts = Post::where('status', 'published')
                    ->latest()
                    ->take(6)
                    ->get();

        return view(
            'user.home',
            compact(
                'headline',
                'sidebarPosts',
                'latestPosts'
            )
        );
    }
}