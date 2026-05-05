@extends('layouts.app')

@section('content')

<h2>Daftar Berita</h2>

@forelse($posts as $post)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        
        <h3>{{ $post->title }}</h3>

        @if($post->image)
            <img src="{{ asset('images/' . $post->image) }}" width="200">
        @endif

        <p>{{ substr($post->content, 0, 100) }}...</p>

        <a href="/post/{{ $post->id }}">Baca Selengkapnya</a>

        <br><br>
        <a href="/admin/edit/{{ $post->id }}">Edit</a> |
        <a href="/admin/delete/{{ $post->id }}" onclick="return confirm('Yakin hapus?')">Delete</a>

    </div>
@empty
    <p>Tidak ada berita</p>
@endforelse

@endsection