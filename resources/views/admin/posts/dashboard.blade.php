@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4 fw-bold">
        Dashboard Admin
    </h2>

    <!-- STATISTIK -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h3>{{ $totalPosts }}</h3>

                    <p>Total Berita</p>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h3>{{ $publishedPosts }}</h3>

                    <p>Diterbitkan</p>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h3>{{ $draftPosts }}</h3>

                    <p>Draft</p>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h3>{{ $totalComments }}</h3>

                    <p>Komentar</p>

                </div>
            </div>
        </div>

    </div>

    <!-- FILTER -->
    <form method="GET">

        <div class="row mb-4">

            <!-- SEARCH -->
            <div class="col-md-4">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari judul berita..."
                    value="{{ request('search') }}"
                >

            </div>

            <!-- CATEGORY -->
            <div class="col-md-3">

                <select
                    name="category"
                    class="form-control"
                >

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id_categories }}"
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- STATUS -->
            <div class="col-md-2">

                <select
                    name="status"
                    class="form-control"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option value="published">
                        Published
                    </option>

                    <option value="draft">
                        Draft
                    </option>

                </select>

            </div>

            <!-- SORT -->
            <div class="col-md-2">

                <select
                    name="sort"
                    class="form-control"
                >

                    <option value="latest">
                        Terbaru
                    </option>

                    <option value="oldest">
                        Terlama
                    </option>

                </select>

            </div>

            <div class="col-md-1">

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    Filter
                </button>

            </div>

        </div>

    </form>

    <!-- TABEL -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Daftar Artikel
            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($posts as $post)

                        <tr>

                            <td width="120">

                                <img
                                    src="{{ asset('images/' . $post->image) }}"
                                    width="100"
                                    class="rounded"
                                >

                            </td>

                            <td>

                                {{ $post->title }}

                            </td>

                            <td>

                                {{ $post->category->name }}

                            </td>

                            <td>

                                @if($post->status == 'published')

                                    <span class="badge bg-success">
                                        Published
                                    </span>

                                @else

                                    <span class="badge bg-warning">
                                        Draft
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $post->created_at }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                Data tidak ditemukan

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection