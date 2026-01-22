<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


{{-- Фон из сетки квадратов --}}
<div class="grid-background" id="gridBackground"></div>

{{--Основной контейнер для контента--}}
<div class="container mt-30vh">

    <div class="container">
        <div class="row">
            {{-- Верхний процент загрузки --}}
            <div class="col-12 ta-c">
                <span class="clr-pink percent">
                    <span class="js-main-loading-percent">0</span>
                    <span>.00</span>
                </span>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2  cy-block">
                {{--  Мобильная версия--}}
                <div class="d-block d-md-none text-center">
                    <span data-cy-timer="1000" class="font-orbitron mb-0 js-cyber-text-once">
                        WELCOME
                    </span>
                </div>
                {{--  Десктопная версия--}}
                <div class="d-none d-md-block text-center">
                    <span data-cy-timer="1000" class="font-orbitron mb-0 js-cyber-text-once">
                        WELCOME_FRIEND
                    </span>
                </div>

            </div>
        </div>
        <br>

        <div class="row">
            {{-- Нижний процент загрузки --}}
            <div class="col-12 ta-c">
                <span class="clr-pink percent">
                    <span class="js-main-loading-percent">0</span>
                    <span>.00</span>
                </span>
            </div>
        </div>

        <div class="row">
            {{-- Индикатор загрузки --}}
            <div class="col-sm-6 col-md-4 col-lg-2 offset-md-1 offset-lg-3 ta-c mb-2">
                <p style="margin-bottom: 2px;">LOADING: </p>
                <div class="br-r" style="height: 7px;">
                    <div class="js-main-loading-style" style="height: 7px; width: 0%; background: #7f7c7c"></div>
                </div>
            </div>
            {{-- Главный процент загрузки --}}
            <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 ta-c loading font-orbitron-slim js-cy-brackets" data-color="orange" data-type="bracket" >
                <span class="clr-pink percent">
                    <span class="js-main-loading-percent">0</span>
                    <span>.00</span>
                </span>
            </div>
        </div>

    </div>

    <h1 class="font-orbitron ta-r">01 .01 .01 1 1 .1</h1>
    <p>Lorem ipsum dolor sit, amet consectetur, adipisicing elit. Placeat nemo ad fuga
        velit commodi pariatur mollitia aliquam ipsam porro similique laboriosam
        laudantium, a enim consequatur officiis aperiam distinctio? Est, officiis.
    </p>
    <br>
    <br>
    <span class="js-cyber-text-animation cy-btn_ cy-char  p-lr-20 w-300 br-r d-block ta-c">
        02 .02 02 .02 223 .02
    </span>
</div>

{{--<div class="container-fluid px-0 bg mh-1200">--}}
{{--    --}}
{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if(session('error'))--}}
{{--        <div class="alert alert-danger">--}}
{{--            {{ session('error') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="site-content">--}}
{{--        @yield('content')--}}
{{--    </div>--}}
{{--</div>--}}
</body>
</html>
