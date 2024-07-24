@extends('layouts.reseapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('icon-script')
<script src="https://kit.fontawesome.com/f4e3175550.js" crossorigin="anonymous"></script>
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
<div class="mypage">
    <h1>{{ $user->name }} さん</h1>
    <div class="mypage__content">
        <div class="reservations">
            <h2>予約状況</h2>
            @forelse($reservations as $index => $reservation)
            <div class="reservation-item">
                <div class="reservation-item__flex">
                    <p><i class="fas fa-clock"></i>　　予約{{ $index + 1 }}</p>
                    <div class="reservation-item__flex__name">
                        <label for="name-{{ $reservation->name }}">Shop</label>
                        <p class="reservation-item__name">{{ $reservation->shop->name ?? 'N/A' }}</p>
                    </div>
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="date-{{ $reservation->id }}">Date</label>
                            <input type="date" id="date-{{ $reservation->id }}" name="date" value="{{ $reservation->date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="time-{{ $reservation->id }}">Time</label>
                            <select id="time-{{ $reservation->id }}" name="time" required>
                                @for ($i = 0; $i < 24; $i++) @php $timeValue=sprintf('%02d:00', $i); $reservationTime=substr($reservation->time, 0, 5);
                                    $selected = $reservationTime == $timeValue ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $timeValue }}" {{ $selected }}>
                                        {{ $timeValue }}
                                    </option>
                                    @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number-{{ $reservation->id }}">Number
                                <select id="number-{{ $reservation->id }}" name="number" required>
                                    @for ($i = 1; $i <= 50; $i++) <option value="{{ $i }}" {{ $reservation->number == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                        </option>
                                        @endfor
                                </select>
                                　　　　　　　人
                            </label>
                        </div>
                        <button class="reservations__update__button" type="submit">
                            予約内容を変更する
                        </button>
                    </form>
                </div>
                <form action="{{ route('reservations.delete', $reservation->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="reservations__delete__button" type="submit" class="delete-button">×</button>
                </form>
            </div>
            @empty
            <p>予約がありません。</p>
            @endforelse
        </div>

        <div class="favorite-shops">
            <h2>お気に入り店舗</h2>
            <div class="shop__content">
                @foreach($favoriteShops as $shop)
                <div class="shop__content__item">
                    <div class="shop__content__image">
                        <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
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
                                <button type="submit" class="favorite-button">
                                    {{ $shop->isFavoritedBy(auth()->user()) ? '❤︎' : '♡' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection