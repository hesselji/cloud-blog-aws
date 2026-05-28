<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('category')
            ->latest()
            ->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'categories_id' => ['required', 'integer', 'exists:categories,id_categories'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $file = $request->file('image');

        if (!$file instanceof UploadedFile) {
            return back()
                ->withInput()
                ->withErrors([
                    'image' => 'File gambar tidak valid.',
                ]);
        }

        $imagePath = $this->uploadImageToS3($file);

        Post::create([
            'title' => $validated['title'],
            'slug' => !empty($validated['slug'])
                ? Str::slug($validated['slug'])
                : Str::slug($validated['title']),
            'content' => $validated['content'],
            'categories_id' => $validated['categories_id'],
            'status' => $validated['status'],
            'image' => $imagePath,
        ]);

        return redirect('/admin/posts')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(int $id): View
    {
        $post = Post::findOrFail($id);

        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'categories_id' => ['nullable', 'integer', 'exists:categories,id_categories'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $post->title = $validated['title'];
        $post->slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']);
        $post->content = $validated['content'];
        $post->status = $validated['status'];

        if (!empty($validated['categories_id'])) {
            $post->categories_id = $validated['categories_id'];
        }

        $file = $request->file('image');

        if ($file instanceof UploadedFile) {
            $this->deleteOldImage($post->image);

            $post->image = $this->uploadImageToS3($file);
        }

        $post->save();

        return redirect('/admin/posts')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function destroy(int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $this->deleteOldImage($post->image);

        $post->delete();

        return redirect('/admin/posts')
            ->with('success', 'Berita berhasil dihapus');
    }

    private function uploadImageToS3(UploadedFile $file): string
    {
        $filename = time() . '_' . Str::random(12) . '.' . $file->getClientOriginalExtension();

        return $file->storeAs('images', $filename, 's3');
    }

    private function deleteOldImage(?string $image): void
    {
        if (!$image) {
            return;
        }

        if (Str::startsWith($image, 'images/')) {
            Storage::disk('s3')->delete($image);
            return;
        }

        $localImagePath = public_path('images/' . $image);

        if (file_exists($localImagePath)) {
            unlink($localImagePath);
        }
    }
}