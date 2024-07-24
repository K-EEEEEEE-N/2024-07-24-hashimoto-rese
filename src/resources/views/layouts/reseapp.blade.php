<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>attendance</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reseapp.css') }}" />
    @yield('css')
    @yield('icon-script')
</head>

<body>
    <header class=header__inner>
        <div class="header__hamburger-menu-list">
            @yield('header__hamburger-menu-list')
        </div>
        <div class="header__title">
            <p class="header__title--p">Rese</p>
        </div>
        @yield('header__search')
    </header>
    <main>
        @yield('content')
        @yield('scripts')
    </main>
</body>