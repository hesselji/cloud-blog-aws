<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN SEMUA BERITA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $posts = Post::with('category')
                    ->latest()
                    ->get();

        return view('admin.posts.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH BERITA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN BERITA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories_id' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // UPLOAD GAMBAR
        $file = $request->file('image');

        $filename = time() . '.' .
                    $file->getClientOriginalExtension();

        $file->move(public_path('images'), $filename);

        // SIMPAN DATA
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug
                        ? Str::slug($request->slug)
                        : Str::slug($request->title),
            'content' => $request->content,
            'categories_id' => $request->categories_id,
            'status' => $request->status,
            'image' => $filename
        ]);

        return redirect('/admin/posts')
                ->with('success', 'Berita berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::all();

        return view(
            'admin.posts.edit',
            compact('post', 'categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

        public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // VALIDASI
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // UPDATE DATA
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;

        // JIKA ADA GAMBAR BARU
        if ($request->hasFile('image')) {

            // HAPUS GAMBAR LAMA
            if (
                $post->image &&
                file_exists(public_path('images/' . $post->image))
            ) {
                unlink(public_path('images/' . $post->image));
            }

            // UPLOAD GAMBAR BARU
            $file = $request->file('image');

            $filename = time() . '.' .
                        $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

            // SIMPAN GAMBAR BARU
            $post->image = $filename;
        }

        $post->save();

        return redirect('/admin/posts')
                ->with('success', 'Berita berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
    $post = Post::where('id_posts', $id)
        ->firstOrFail();

    // HAPUS GAMBAR
    if (
        $post->image &&
        file_exists(public_path('images/' . $post->image))
    ) {
        unlink(
            public_path('images/' . $post->image)
        );
    }

    // HAPUS DATA POST
    $post->delete();

    return redirect('/admin/posts')
        ->with('success', 'Berita berhasil dihapus');
    }
}