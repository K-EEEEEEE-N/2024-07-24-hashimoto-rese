@extends('layouts.reseapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
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

@section('content')
<div class="shop-detail">
    <div class="shop-detail__left">
        <div class="shop-detail__left__name">
            <a href="/" class="shop-detail__left__name__a"><</a>
            <h1 class="shop-detail__left__name__h1">{{ $shop->name }}</h1>
        </div>
        <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
        <div class="shop-detail__left__p">
            <p class="shop-detail__left__p__area">#{{ $shop->area->name }}</p>
            <p class="shop-detail__left__p__genre">#{{ $shop->genre->name }}</p>
        </div>
        <p class="shop-detail__left__description">{{ $shop->description }}</p>
    </div>
    <div class="shop-detail__right">
        <h2>予約</h2>
        <form action="{{ route('shops.reserve', $shop->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <select id="time" name="time" required>
                    @for ($i = 1; $i <= 24; $i++) <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        @endfor
                </select>
            </div>
            <div class="form-group">
                <select id="number" name="number" required>
                    @for ($i = 1; $i <= 50; $i++) <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                </select>
            </div>
            <div class="reservation-summary">
                <p>Shop <span id="shop-name">{{ $shop->name }}</span></p>
                <p>Date <span id="selected-date"></span></p>
                <p>Time <span id="selected-time"></span></p>
                <p>Number <span id="selected-number"></span>　　　　　人</p>
            </div>
            <button type="submit">予約する</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('date').addEventListener('change', function() {
        document.getElementById('selected-date').textContent = this.value;
    });
    document.getElementById('time').addEventListener('change', function() {
        document.getElementById('selected-time').textContent = this.value;
    });
    document.getElementById('number').addEventListener('change', function() {
        document.getElementById('selected-number').textContent = this.value;
    });
</script>
@endsection