@extends('layouts/reseapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('header__hamburger-menu-list')
<!-- ハンバーガーメニュー部分 -->
<div class="nav">

    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
        <ul class="nav_list">
            <li class="nav_item"><a href="/">Home</a></li>
            <li class="nav_item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            <li class="nav_item"><a href="{{ route('mypage') }}">Mypage</a></li>
        </ul>
    </nav>

</div>
@endsection

@section('header__search')
<div class="header__search">
    <form id="searchForm" action="{{ route('shops.index') }}" method="GET">
        @csrf
        <ul class="header__search__list">
            <li class="header__search__list__li__area">
                <select class="header__search__list__li__area__select" name="area_id" onchange="submitSearchForm()">
                    <option value="">All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </li>
            <li class="header__search__list__li__genre">
                <select class="header__search__list__li__genre__select" name="genre_id" onchange="submitSearchForm()">
                    <option value="">All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </li>
            <li class="header__search__list__li__name">
                <img class="header__search__list__li__name__icon" width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/737373/search--v1.png" alt="search--v1" />
                <input class="header__search__list__li__name__select" type="text" name="name" value="{{ request('name') }}" placeholder="Search..." oninput="delayedSubmitSearchForm()">
            </li>
        </ul>
    </form>
</div>
@endsection

@section('content')
<div class="shop__content">
    @foreach($shops as $shop)
    <div class="shop__content__item">
        <div class="shop__content__image">
            <img src="{{ $shop->image }}" alt="{{$shop->name}}">
        </div>
        <div class="shop__content__profile">
            <h2 class="shop__content__profile__name">
                {{ $shop->name }}
            </h2>
            <div class="shop__content__profile__tag">
                <span class="shop__content__profile__tag__area">
                    #{{ optional($shop->area)->name ?? 'N/A' }}
                </span>
                <span class="shop__content__profile__tag__genre">
                    #{{ optional($shop->genre)->name ?? 'N/A' }}
                </span>
            </div>
            <div class="shop__content__profile__more">
                <a href="{{ route('shops.show', $shop->id) }}" class="shop__content__profile__more__a">
                    詳しくみる
                </a>
                <form action="{{ route('favorites.toggle', $shop->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="favorite-button {{ $shop->isFavoritedBy(auth()->user()) ? 'favorited' : '' }}">
                        {{ $shop->isFavoritedBy(auth()->user()) ? '❤︎' : '❤︎' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    let delayTimer;

    function delayedSubmitSearchForm() {
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function() {
            submitSearchForm();
        }, 2000); // 2000ミリ秒のディレイを設定
    }

    function submitSearchForm() {
        document.getElementById('searchForm').submit();
    }

    document.querySelectorAll('.favorite-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const button = form.querySelector('.favorite-button');
            const isFavorited = button.classList.contains('favorited');

            button.disabled = true; // 重複クリックを防ぐ

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    button.classList.toggle('favorited', !isFavorited);
                    button.textContent = isFavorited ? '♡' : '❤︎';
                }
            }).finally(() => {
                button.disabled = false;
            });
        });
    });
</script>
@endsection