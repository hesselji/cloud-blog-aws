@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-5">

        <h1 class="fw-bold">
            Kategori: {{ $category->name }}
        </h1>

        <p class="text-muted">
            Menampilkan semua berita kategori {{ $category->name }}
        </p>

    </div>

    {{-- LIST BERITA --}}
    <div class="row">

        @forelse($posts as $post)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    {{-- IMAGE --}}
                    @if($post->image)

                        <img
                            src="{{ asset('images/' . $post->image) }}"
                            class="card-img-top rounded-top-4"
                            style="height:230px; object-fit:cover;"
                        >

                    @endif

                    <div class="card-body d-flex flex-column">

                        {{-- CATEGORY --}}
                        <div class="mb-2">

                            <span class="badge bg-danger">

                                {{ $post->category->name ?? 'Berita' }}

                            </span>

                        </div>

                        {{-- TITLE --}}
                        <h5 class="fw-bold">

                            {{ $post->title }}

                        </h5>

                        {{-- CONTENT --}}
                        <p class="text-muted">

                            {{ \Illuminate\Support\Str::limit($post->content, 100) }}

                        </p>

                        {{-- BUTTON --}}
                        <div class="mt-auto">

                            <a href="/post/{{ $post->id }}"
                               class="btn btn-dark btn-sm">

                                Baca Selengkapnya

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    Belum ada berita pada kategori ini.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection