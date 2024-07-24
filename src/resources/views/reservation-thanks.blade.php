@extends('layouts.reseapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation-thanks.css') }}" />
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
<div class="reservation-thanks">
    <h1>ご予約ありがとうございます</h1>
    <a href="{{ route('shops.index') }}">戻る</a>
</div>
@endsection