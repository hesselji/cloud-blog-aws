<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // UPLOAD GAMBAR
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // SIMPAN DATA
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $filename
        ]);

        return redirect('/')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // VALIDASI
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // UPDATE DATA
        $post->title = $request->title;
        $post->content = $request->content;

        // JIKA ADA GAMBAR BARU
        if ($request->hasFile('image')) {

            // hapus gambar lama (opsional tapi bagus)
            if ($post->image && file_exists(public_path('images/' . $post->image))) {
                unlink(public_path('images/' . $post->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);

            $post->image = $filename;
        }

        $post->save();

        return redirect('/')->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // hapus gambar dari folder
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }

        $post->delete();

        return redirect('/')->with('success', 'Berita berhasil dihapus');
    }
}