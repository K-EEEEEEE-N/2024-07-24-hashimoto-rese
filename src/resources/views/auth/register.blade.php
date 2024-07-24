<div class="header">
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
    <div class="header__title">
        <p class="header__title--p">Rese</p>
    </div>
</div>
<div class="register__body">
    <x-guest-layout>
        <!--Title-->
        <div class="register__title">
            <p class="register__title--p">Registration</p>
        </div>
        <div class="register__content">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form class="register__form" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/1A1A1A/guest-male--v1.png" alt="guest-male--v1" />

                    <x-input id="name" class="block mt-1 w-full border-t-0 border-l-0 border-r-0 rounded-none shadow-none" type="text" name="name" :value="old('name')" required autofocus placeholder="Username" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/1A1A1A/mail.png" alt="mail" />

                    <x-input id="email" class="block mt-1 w-full border-t-0 border-l-0 border-r-0 rounded-none shadow-none" type="email" name="email" :value="old('email')" required placeholder="Email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <img width="48" height="48" src="https://img.icons8.com/material-sharp/48/1A1A1A/lock--v1.png" alt="lock--v1" />

                    <x-input id="password" class="block mt-1 w-full border-t-0 border-l-0 border-r-0 rounded-none shadow-none" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                </div>

                <div class="flex items-center justify-end mt-4 ">
                    <x-button class="ml-4 bg-blue-700">
                        {{ __('登録') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-guest-layout>
</div>