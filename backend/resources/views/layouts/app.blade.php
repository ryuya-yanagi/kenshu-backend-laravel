<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Custom head-->
    @yield('head')
</head>

<body>
    <header class="bg-light">
        <nav class="container navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/laravel-logo.png" alt="bland" width="40" height="40" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/users">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('articles*') ? 'active' : '' }}"
                                href="/articles">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tags*') ? 'active' : '' }}" href="/tags">Tags</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tags/new') ? 'active' : '' }}" href="/tags/new">New
                                Tag</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('articles/new') ? 'active' : '' }}"
                                href="/articles/new">New Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('mypage') ? 'active' : '' }}" href="/mypage">MyPage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/logout">Logout</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('auth/login') ? 'active' : '' }}"
                                href="/auth/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('auth/register') ? 'active' : '' }}"
                                href="/auth/register">SignUp</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>
