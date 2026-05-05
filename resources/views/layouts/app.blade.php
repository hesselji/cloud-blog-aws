<!DOCTYPE html>
<html>
<head>
    <title>Blog Berita</title>
</head>
<body>
    <h1>Blog Berita</h1>
    @yield('content')
</body>
@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
</html>