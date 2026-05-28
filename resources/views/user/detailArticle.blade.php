@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')

<div class="container py-4">

    {{-- Breadcrumb --}}
    <div class="mb-4 text-muted small">

        <a href="/" class="text-decoration-none text-secondary">
            <i class="bi bi-house"></i>
        </a>

        <span class="mx-2">></span>

        <a href="#" class="text-decoration-none text-secondary">
            {{ $article->category->name ?? 'Berita' }}
        </a>

        <span class="mx-2">></span>

        <span>
            {{ $article->title }}
        </span>

    </div>

    <div class="row">

        {{-- CONTENT --}}
        <div class="col-lg-8">

            {{-- IMAGE --}}
            <div class="mb-3">

                @if($article->image)

                    <img
                       src="{{ $article->image_url }}" alt="{{ $article->title }}"
                        class="img-fluid rounded-4 shadow-sm w-100"
                        style="height:500px; object-fit:cover;"
                    >

                @else

                    <img
                        src="https://placehold.co/1200x500?text=No+Image"
                        class="img-fluid rounded-4 shadow-sm w-100"
                    >

                @endif

            </div>

            {{-- META --}}
            <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">

                <span class="badge bg-danger px-3 py-2">
                    {{ $article->category->name ?? 'Berita' }}
                </span>

                <span class="text-muted small">
                    <i class="bi bi-clock"></i>
                    {{ $article->created_at->diffForHumans() }}
                </span>

            </div>

            {{-- TITLE --}}
            <h1 class="fw-bold display-5 mb-4">
                {{ $article->title }}
            </h1>

            {{-- AUTHOR --}}
            <div class="border-top border-bottom py-3 mb-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:50px;height:50px;"
                        >
                            A
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Admin
                            </div>

                            <div class="small text-muted">
                                {{ $article->created_at->format('d F Y • H:i') }}
                            </div>

                        </div>

                    </div>

                    {{-- SHARE --}}
                    <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">

                        <span class="text-muted small">
                            BAGIKAN
                        </span>

                        <a href="#" class="btn btn-light rounded-circle">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="#" class="btn btn-light rounded-circle">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#" class="btn btn-light rounded-circle">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                    </div>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="article-content">

                {!! $article->content !!}

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            {{-- RELATED POSTS --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Artikel Terkait
                    </h4>

                    @forelse($relatedPosts as $item)

                        <a
                            href="/post/{{ $item->id_posts }}"
                            class="text-decoration-none text-dark"
                        >

                            <div class="d-flex gap-3 mb-4">

                                @if($item->image)

                                    <img
                                        src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                        width="120"
                                        height="80"
                                        class="rounded-3"
                                        style="object-fit:cover;"
                                    >

                                @else

                                    <img
                                        src="https://placehold.co/120x80?text=No+Image"
                                        width="120"
                                        height="80"
                                        class="rounded-3"
                                    >

                                @endif

                                <div>

                                    <div class="mb-2">

                                        <span class="badge bg-danger">
                                            {{ $item->category->name ?? 'Berita' }}
                                        </span>

                                    </div>

                                    <div class="fw-semibold">
                                        {{ Str::limit($item->title, 60) }}
                                    </div>

                                    <div class="small text-muted mt-2">
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>

                                </div>

                            </div>

                        </a>

                    @empty

                        <div class="alert alert-secondary">
                            Tidak ada artikel terkait.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection