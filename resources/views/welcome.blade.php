@php use App\Models\User; @endphp
@extends('layouts.main')
@section('content')
    <style>
        * {color: white}
    </style>

    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    <p>Войти через <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id={{ $yandexClientId }}">Yandex</a></p>

    <?php
    $redirectUri = 'http://localhost:8080/github/verification-code';
    ?>

    <p>Войти через
        <a href="https://github.com/login/oauth/authorize?client_id={{ $githubClientId }}&redirect_uri={{ $redirectUri }}&scope=user:email">
            Github
        </a>
    </p>

    <p>Войти через
        <a href="{{ route('google.login') }}">
            Google
        </a>
    </p>


    <?php
    /** @var User $u */
//    $u = Auth::user();
//    $account = $u->oauthAccounts->first();
//    if ($account) {
//        $accessToken = $account->access_token;
//        $refreshToken = $account->refresh_token;
//        dd($accessToken, $refreshToken);
//    }

 ?>

    @auth
        <p>{{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>

        <br>
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    @endauth
@endsection

