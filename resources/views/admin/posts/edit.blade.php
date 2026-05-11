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
                               value="{{ $post->title }}"
                               required>

                    </div>

                    {{-- KONTEN --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Isi Berita
                        </label>

                        <textarea name="content"
                                  rows="12"
                                  class="form-control"
                                  required>{{ $post->content }}</textarea>

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
                                {{ $post->status == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ $post->status == 'published' ? 'selected' : '' }}>
                                Publish
                            </option>

                        </select>

                    </div>

                    {{-- BUTTON --}}
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

                    {{-- PREVIEW GAMBAR LAMA --}}
                    @if($post->image)

                        <img
                            src="{{ asset('images/' . $post->image) }}"
                            class="img-fluid rounded mb-3"
                            id="preview"
                        >

                    @else

                        <img
                            id="preview"
                            class="img-fluid rounded mb-3 d-none"
                        >

                    @endif

                    {{-- INPUT FILE --}}
                    <input type="file"
                           name="image"
                           class="form-control"
                           onchange="previewImage(event)">

                </div>

            </div>

        </div>

    </div>

</form>

{{-- PREVIEW IMAGE --}}
<script>

function previewImage(event)
{
    let reader = new FileReader();

    reader.onload = function()
    {
        let output = document.getElementById('preview');

        output.src = reader.result;

        output.classList.remove('d-none');
    }

    reader.readAsDataURL(event.target.files[0]);
}

</script>

@endsection