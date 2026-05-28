@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')

<form action="{{ route('admin.posts.update', $post->id_posts) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="row">

        {{-- KONTEN KIRI --}}
        <div class="col-lg-8">

            {{-- INFORMASI DASAR --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Edit Berita
                    </h5>

                </div>

                <div class="card-body">

                    {{-- JUDUL --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Judul Berita
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control form-control-lg"
                               value="{{ old('title', $post->title) }}"
                               required>

                    </div>

                    {{-- SLUG --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Slug URL
                        </label>

                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="{{ old('slug', $post->slug) }}">

                    </div>

                    {{-- KONTEN --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Isi Berita
                        </label>

                        <textarea name="content"
                                  rows="12"
                                  class="form-control"
                                  required>{{ old('content', $post->content) }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            {{-- PUBLIKASI --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Publikasi
                    </h5>

                </div>

                <div class="card-body">

                    {{-- STATUS --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="draft"
                                {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                Publish
                            </option>

                        </select>

                    </div>

                    {{-- KATEGORI --}}
                    @isset($categories)

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select name="categories_id"
                                class="form-select">

                            @foreach($categories as $category)

                                <option value="{{ $category->id_categories }}"
                                    {{ old('categories_id', $post->categories_id) == $category->id_categories ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    @endisset

                    <button type="submit"
                            class="btn btn-danger w-100">

                        Update Berita

                    </button>

                </div>

            </div>

            {{-- THUMBNAIL --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Thumbnail Berita
                    </h5>

                </div>

                <div class="card-body">

                    {{-- PREVIEW GAMBAR LAMA / S3 --}}
                    @if($post->image_url)

                        <img
                            src="{{ $post->image_url }}"
                            alt="{{ $post->title }}"
                            class="img-fluid rounded mb-3"
                            id="preview"
                            style="width: 100%; max-height: 220px; object-fit: cover;"
                        >

                    @else

                        <img
                            id="preview"
                            class="img-fluid rounded mb-3 d-none"
                            style="width: 100%; max-height: 220px; object-fit: cover;"
                        >

                    @endif

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/jpeg,image/png,image/jpg"
                           onchange="previewImage(event)">

                    <small class="text-muted d-block mt-2">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>

            </div>

        </div>

    </div>

</form>

<script>
function previewImage(event)
{
    const file = event.target.files[0];

    if (!file) {
        return;
    }

    const reader = new FileReader();

    reader.onload = function()
    {
        const output = document.getElementById('preview');

        output.src = reader.result;

        output.classList.remove('d-none');
    }

    reader.readAsDataURL(file);
}
</script>

@endsection