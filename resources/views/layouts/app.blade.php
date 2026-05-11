<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
            font-family: Arial, sans-serif;
        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR
        |--------------------------------------------------------------------------
        */

        .navbar{
            background:#071120;
        }

        .navbar a{
            color:white !important;
        }

        .navbar .nav-link{
            margin:0 8px;
            font-weight:500;
            transition:0.3s;
        }

        .navbar .nav-link:hover{
            color:#ef4444 !important;
        }

        .navbar .active{
            color:#ef4444 !important;
            font-weight:bold;
        }

        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero-card{
            position:relative;
            overflow:hidden;
            border-radius:20px;
        }

        .hero-card img{
            width:100%;
            height:500px;
            object-fit:cover;
            filter:brightness(60%);
        }

        .hero-content{
            position:absolute;
            bottom:40px;
            left:40px;
            color:white;
            max-width:700px;
        }

        .hero-content h1{
            font-size:48px;
            font-weight:bold;
        }

        /*
        |--------------------------------------------------------------------------
        | NEWS CARD
        |--------------------------------------------------------------------------
        */

        .news-card{
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .news-card img{
            width:100%;
            height:180px;
            object-fit:cover;
        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

        .sidebar-card{
            background:white;
            border-radius:15px;
            overflow:hidden;
            margin-bottom:20px;
        }

        .sidebar-card img{
            width:100%;
            height:180px;
            object-fit:cover;
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */

        .section-title{
            font-weight:bold;
            font-size:32px;
        }

    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark py-3">

    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand fw-bold fs-3" href="/">
            NewsHub
        </a>

        {{-- MOBILE BUTTON --}}
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav mx-auto">

                {{-- BERANDA --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="/">

                        Beranda

                    </a>

                </li>

                {{-- POLITIK --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('category/politik') ? 'active' : '' }}"
                        href="/category/politik">

                        Politik

                    </a>

                </li>

                {{-- EKONOMI --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('category/ekonomi') ? 'active' : '' }}"
                        href="/category/ekonomi">

                        Ekonomi

                    </a>

                </li>

                {{-- OLAHRAGA --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('category/olahraga') ? 'active' : '' }}"
                        href="/category/olahraga">

                        Olahraga

                    </a>

                </li>

                {{-- TEKNOLOGI --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->is('category/teknologi') ? 'active' : '' }}"
                        href="/category/teknologi">

                        Teknologi

                    </a>

                </li>

            </ul>

            {{-- BUTTON ADMIN --}}
            <a href="/admin/posts"
               class="btn btn-danger px-4">

                Dashboard

            </a>

        </div>

    </div>

</nav>

{{-- CONTENT --}}
<div class="container py-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>