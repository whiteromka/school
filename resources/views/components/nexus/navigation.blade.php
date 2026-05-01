@php use Illuminate\Support\Facades\Auth; @endphp
<div class="container-fluid px-0 pos-r">
    <nav class="nexus-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-logo">station</div>
        {{--        <div class="nav-logo">voyager</div>--}}
        {{--        <div class="nav-logo">polymer</div>--}}
        <div class="nav-logo-under">technologies hub</div>

        <ul class="nav-links d-none d-md-flex">
            <li><a href="{{ route('site.index') }}">Главная</a></li>
            <li><a href="{{ route('site.front') }}">Front</a></li>
            <li><a href="{{ route('site.back') }}">Back</a></li>
            <li><a href="{{ route('site.gamedev') }}">Gamedev</a></li>
            <li><a href="{{ route('site.english') }}">English</a></li>
        </ul>
        <!-- MENU DROPDOWN -->
        <div class="nav-status dropdown">
            <span class="dot"></span>
            <a
                class="guest dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                {{ Auth::check() ? Auth::user()->getNameOrEmail() : 'menu' }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end nexus-dropdown">
                {{-- Эти будут показываться если устройство меньше чем md --}}
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.index') }}">Главная</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.front') }}">Front</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.back') }}">Back</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="{{ route('site.gamedev') }}">Gamedev</a></li>
                <li class="d-md-none"><a class="dropdown-item" href="#">English</a></li>
                @guest
                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Registration</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    {{--  тут голосовое сообщение  --}}
    <div class="voice-message-wrapper">
        <div class="voice-message">
             <span style="width: 32px">
{{--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>--}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M55.1 73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L147.2 256 9.9 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192.5 301.3 329.9 438.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.8 256 375.1 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192.5 210.7 55.1 73.4z"/></svg>
             </span>
            <span>Voice message:</span>
            <span>Roman B.</span>
            {{-- Кнопка play --}}
            <span style="width: 34px">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M249.3 235.8c10.2 12.6 9.5 31.1-2.2 42.8l-128 128c-9.2 9.2-22.9 11.9-34.9 6.9S64.5 396.9 64.5 384l0-256c0-12.9 7.8-24.6 19.8-29.6s25.7-2.2 34.9 6.9l128 128 2.2 2.4z"/></svg>
            </span>
        </div>

        <div class="ico-voice-message">
            <div class="voice-bar voice-bar"></div>
            <div class="voice-bar voice-bar-10"></div>
            <div class="voice-bar voice-bar-30"></div>
            <div class="voice-bar voice-bar-20"></div>
            <div class="voice-bar voice-bar-10"></div>
            <div class="voice-bar voice-bar"></div>
            <div class="voice-bar voice-bar-30"></div>
            <div class="voice-bar voice-bar-20"></div>
            <div class="voice-bar voice-bar-10"></div>
            <div class="voice-bar voice-bar"></div>
            <div class="voice-bar voice-bar-30"></div>
            <div class="voice-bar voice-bar-20"></div>
            <div class="voice-bar voice-bar-10"></div>
            <div class="voice-bar voice-bar"></div>

        </div>
    </div>

</div>
