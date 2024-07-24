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
</div>
<div class="login__body">
    <x-guest-layout>
        <div class="login__title">
            <p class="login__title--p">Login</p>
        </div>
        <x-auth-card>
            <x-slot name="logo">
            </x-slot>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/1A1A1A/mail.png" alt="mail" />

                    <x-input id="email" class="block mt-1 w-full border-t-0 border-l-0 border-r-0 rounded-none shadow-none" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <img width="48" height="48" src="https://img.icons8.com/material-sharp/48/1A1A1A/lock--v1.png" alt="lock--v1" />

                    <x-input id="password" class="block mt-1 w-full border-t-0 border-l-0 border-r-0 rounded-none shadow-none" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                </div>
                <div class="flex items-center justify-end mt-4 ">
                    <x-button class="ml-4 bg-blue-800">
                        {{ __('ログイン') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</div>