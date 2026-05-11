@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')

<form action="/admin/posts/store"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="row">

        {{-- KONTEN KIRI --}}
        <div class="col-lg-8">

            {{-- INFORMASI DASAR --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        Informasi Dasar
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
                               placeholder="Masukkan judul berita"
                               required>

                    </div>

                    {{-- SLUG --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Slug URL
                        </label>

                        <input type="text"
                               name="slug"
                               class="form-control"
                               placeholder="slug-berita">

                    </div>

                </div>

            </div>

            {{-- KONTEN ARTIKEL --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        Konten Artikel
                    </h5>
                </div>

                <div class="card-body">

                    <textarea name="content"
                              rows="12"
                              class="form-control"
                              placeholder="Tulis isi berita..."
                              required></textarea>

                </div>

            </div>

        </div>

        {{-- SIDEBAR KANAN --}}
        <div class="col-lg-4">

            {{-- PUBLIKASI --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
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

                            <option value="draft">
                                Draft
                            </option>

                            <option value="published">
                                Publish
                            </option>

                        </select>

                    </div>

                    {{-- PENULIS --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Penulis
                        </label>

                        <input type="text"
                               class="form-control"
                               value="Admin"
                               readonly>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                            class="btn btn-danger w-100 py-2">

                        Terbitkan Berita

                    </button>

                </div>

            </div>

            {{-- THUMBNAIL --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        Thumbnail Berita
                    </h5>
                </div>

                <div class="card-body">

                    <input type="file"
                           name="image"
                           class="form-control"
                           onchange="previewImage(event)"
                           required>

                    <img id="preview"
                         class="img-fluid rounded mt-3 d-none">

                </div>

            </div>

            {{-- KATEGORI --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        Kategori
                    </h5>
                </div>

                <div class="card-body">

                    <select name="categories_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id_categories }}">

                                {{ $category->name }}

                            </option>

                        @endforeach

                       
                    </select>

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