@extends('layouts/reseapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
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
            <li class="nav_item"><a href="/register">Registration</a></li>
            <li class="nav_item"><a href="/login">Login</a></li>
        </ul>
    </nav>

</div>
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__content__item">
        <p class="thanks__content__item__thanks">会員登録ありがとうございます</p>
        <a href="/login" class="thanks__content__item__login">ログインする</a>
    </div>
</div>
@endsection