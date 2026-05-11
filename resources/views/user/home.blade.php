@extends('layouts.app')

@section('content')

<div class="row">

    {{-- HEADLINE --}}
    <div class="col-lg-9">

        @if($headline)

        <div class="hero-card">

            @if($headline->image)
                <img src="{{ asset('images/' . $headline->image) }}">
            @endif

            <div class="hero-content">

                <span class="badge bg-danger mb-3">
                    {{ $headline->category->name ?? 'Berita' }}
                </span>

                <h1>
                    {{ $headline->title }}
                </h1>

                <p>
                    {{ \Illuminate\Support\Str::limit($headline->content, 150) }}
                </p>

                <a href="/post/{{ $headline->id_posts }}"
                   class="btn btn-danger px-4 py-2">
                    Baca Selengkapnya
                </a>

            </div>

        </div>

        @else

            <div class="alert alert-warning">
                Belum ada berita headline.
            </div>

        @endif

    </div>

    {{-- SIDEBAR --}}
    <div class="col-lg-3">

        @forelse($sidebarPosts as $post)

            <div class="sidebar-card mb-3">

                @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}">
                @endif

                <div class="p-3">

                    <span class="badge bg-success mb-2">
                        {{ $post->category->name ?? 'Berita' }}
                    </span>

                    <h5>
                        {{ $post->title }}
                    </h5>

                    <a href="/post/{{ $post->id_posts }}">
                        Baca
                    </a>

                </div>

            </div>

        @empty

            <div class="alert alert-secondary">
                Tidak ada berita sidebar.
            </div>

        @endforelse

    </div>

</div>

{{-- BERITA TERKINI --}}
<div class="mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title">
            Berita Terkini
        </h2>

        <a href="#">
            Lihat Semua
        </a>

    </div>

    <div class="row">

        @forelse($latestPosts as $post)

            <div class="col-md-4 mb-4">

                <div class="news-card h-100">

                    @if($post->image)
                        <img src="{{ asset('images/' . $post->image) }}">
                    @endif

                    <div class="p-3">

                        <span class="badge bg-primary mb-2">
                            {{ $post->category->name ?? 'Berita' }}
                        </span>

                        <h5>
                            {{ $post->title }}
                        </h5>

                        <p>
                            {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                        </p>

                        <a href="/post/{{ $post->id_posts }}"
                           class="btn btn-dark btn-sm">
                            Detail
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-secondary">
                    Belum ada berita terbaru.
                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection