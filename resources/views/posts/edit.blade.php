@extends('layouts.app')

@section('content')

<h2>Edit Berita</h2>

<form action="/admin/update/{{ $post->id }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" value="{{ $post->title }}"><br><br>

    <textarea name="content">{{ $post->content }}</textarea><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>

</form>

@endsection