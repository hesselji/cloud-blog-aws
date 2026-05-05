@extends('layouts.app')

@section('content')

<h2>Tambah Berita</h2>

<form action="/admin/store" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Judul"><br><br>

    <textarea name="content" placeholder="Isi berita"></textarea><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Simpan</button>

</form>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection