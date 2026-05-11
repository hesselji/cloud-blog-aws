@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

        <h5 class="fw-bold mb-0">
            Daftar Artikel
        </h5>

        <!-- BUTTON TAMBAH -->
        <a href="/admin/posts/create"
           class="btn btn-danger">

            <i class="fa fa-plus me-2"></i>

            Tambah Berita

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="120">Foto</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($posts as $post)

                    <tr>

                        <!-- FOTO -->
                        <td>

                            <img
                                src="{{ asset('images/' . $post->image) }}"
                                class="img-fluid rounded"
                                width="100"
                            >

                        </td>

                        <!-- JUDUL -->
                        <td>

                            <div class="fw-bold mb-1">

                                {{ $post->title }}

                            </div>

                            <small class="text-muted">

                                {{ Str::limit($post->content, 60) }}

                            </small>

                        </td>

                        <!-- STATUS -->
                        <td>

                            @if($post->status == 'published')

                                <span class="badge bg-success">

                                    Publish

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Draft

                                </span>

                            @endif

                        </td>

                        <!-- TANGGAL -->
                        <td>

                            {{ $post->created_at->format('d M Y') }}

                        </td>

                        <!-- AKSI -->
                        <td>

                            <!-- EDIT -->
                            <a href="/admin/posts/edit/{{ $post->id_posts }}"
                               class="btn btn-primary btn-sm">

                                <i class="fa fa-pen"></i>

                            </a>

                            <!-- DELETE -->
                            <a href="/admin/posts/delete/{{ $post->id_posts }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin hapus berita?')">

                                <i class="fa fa-trash"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-4">

                            Belum ada berita

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection