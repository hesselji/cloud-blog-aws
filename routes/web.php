<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\CategoryController;

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\DashboardController;

//
// USER
//

// HOME
Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

// DETAIL ARTICLE
Route::get(
    '/post/{id}',
    [PostController::class, 'show']
)->name('post.show');

// CATEGORY
Route::get(
    '/category/{slug}',
    [CategoryController::class, 'show']
)->name('category.show');

//
// ADMIN
//

Route::prefix('admin')->group(function () {

    // DASHBOARD
    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('admin.dashboard');

    //
    // POSTS
    //

    // INDEX
    Route::get(
        '/posts',
        [AdminPostController::class, 'index']
    )->name('admin.posts.index');

    // CREATE
    Route::get(
        '/posts/create',
        [AdminPostController::class, 'create']
    )->name('admin.posts.create');

    // STORE
    Route::post(
        '/posts/store',
        [AdminPostController::class, 'store']
    )->name('admin.posts.store');

    // EDIT
    Route::get(
        '/posts/edit/{id}',
        [AdminPostController::class, 'edit']
    )->name('admin.posts.edit');

    // UPDATE
    Route::post(
        '/posts/update/{id}',
        [AdminPostController::class, 'update']
    )->name('admin.posts.update');

    // DELETE
    Route::get(
        '/posts/delete/{id}',
        [AdminPostController::class, 'destroy']
    )->name('admin.posts.delete');

});