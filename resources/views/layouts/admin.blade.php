<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background:#f5f6fa;
            font-family:Arial, sans-serif;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background:#071120;
            color:white;
            padding:20px;
            overflow-y:auto;
        }

        .sidebar .logo{
            font-size:28px;
            font-weight:bold;
            margin-bottom:40px;
            color:white;
        }

        .sidebar a{
            color:#cbd5e1;
            text-decoration:none;
            display:block;
            padding:12px 15px;
            border-radius:12px;
            margin-bottom:10px;
            transition:0.3s;
        }

        .sidebar a:hover,
        .sidebar .active{
            background:#ef4444;
            color:white;
        }

        /* MAIN */

        .main{
            margin-left:260px;
            padding:30px;
        }

        /* TOPBAR */

        .topbar{
            background:white;
            padding:15px 25px;
            border-radius:15px;
            margin-bottom:25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        /* CARD */

        .card{
            border:none;
            border-radius:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        /* FORM */

        .form-control,
        .form-select{
            border-radius:12px;
            padding:12px;
        }

        .btn{
            border-radius:12px;
        }

        /* TABLE */

        .table-box{
            background:white;
            border-radius:20px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .table img{
            width:80px;
            height:50px;
            object-fit:cover;
            border-radius:8px;
        }

        /* STATUS */

        .badge-status{
            padding:8px 14px;
            border-radius:30px;
            font-size:12px;
        }

        .published{
            background:#dcfce7;
            color:#16a34a;
        }

        .draft{
            background:#fef3c7;
            color:#d97706;
        }

    </style>

</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="logo">
            NewsHub
        </div>

        <p class="text-secondary small">MENU UTAMA</p>

        {{-- DASHBOARD --}}
        <a href="/admin/dashboard"
           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">

            <i class="fa fa-home me-2"></i>
            Dashboard
        </a>

        {{-- KELOLA BERITA --}}
        <a href="/admin/posts"
           class="{{ request()->is('admin/posts') ? 'active' : '' }}">

            <i class="fa fa-newspaper me-2"></i>
            Kelola Berita
        </a>

        {{-- TAMBAH BERITA --}}
        <a href="/admin/posts/create"
           class="{{ request()->is('admin/posts/create') ? 'active' : '' }}">

            <i class="fa fa-plus me-2"></i>
            Tambah Berita
        </a>

        <hr class="text-secondary">

        <p class="text-secondary small">KONTEN</p>

        {{-- KATEGORI --}}
        <a href="#">
            <i class="fa fa-tags me-2"></i>
            Kategori
        </a>

        {{-- KOMENTAR --}}
        <a href="#">
            <i class="fa fa-comments me-2"></i>
            Komentar
        </a>

        {{-- MEDIA --}}
        <a href="#">
            <i class="fa fa-image me-2"></i>
            Media
        </a>

    </div>

    {{-- MAIN CONTENT --}}
    <div class="main">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div>
                <h3 class="fw-bold mb-0">
                    @yield('title')
                </h3>
            </div>

            <div>

                <button class="btn btn-light">
                    <i class="fa fa-bell"></i>
                </button>

                <button class="btn btn-light">
                    <i class="fa fa-search"></i>
                </button>

                <a href="/" class="btn btn-danger">
                    Lihat Website
                </a>

            </div>

        </div>

        {{-- CONTENT --}}
        @yield('content')

    </div>

</body>
</html>
