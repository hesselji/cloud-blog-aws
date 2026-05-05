@extends('layouts.app')

@section('content')

<h2>{{ $post->title }}</h2>

@if($post->image)
    <img src="/images/{{ $post->image }}" width="300">
@endif

<p>{{ $post->content }}</p>

<a href="/">← Kembali</a>

@endsection