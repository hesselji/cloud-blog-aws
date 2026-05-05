<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

// Homepage
Route::get('/', [PostController::class, 'index']);

// Detail berita
Route::get('/post/{id}', [PostController::class, 'show']);

// Admin
Route::get('/admin/create', [AdminController::class, 'create']);
Route::post('/admin/store', [AdminController::class, 'store']);
Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
Route::post('/admin/update/{id}', [AdminController::class, 'update']);
Route::post('/admin/delete/{id}', [AdminController::class, 'destroy']);