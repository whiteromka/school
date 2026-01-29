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
<div class="container-fluid mt-10vh px-0">

    {{-- Вступительный контейнер    --}}
    <x-cyber.main-first></x-cyber.main-first>
    <br>
    <br>
    <br>
    <br>

    {{--  Контейнер преимущества  --}}
    <x-cyber.advantages></x-cyber.advantages>
    <br>
    <br>
    <br>
    <br>


    {{-- Обычный двойной Контейнер --}}
    <x-cyber.simple-double></x-cyber.simple-double>
    <br>
    <br>
    <br>
    <br>


    {{-- Широкий контейнер с itmes начало --}}
    <x-cyber.items></x-cyber.items>



    {{-- Двойной контейнер с 3d визуализацией --}}
    <x-cyber.perspective3d></x-cyber.perspective3d>
    <br>
    <br>

    {{-- Контейнер network с технологиями начало--}}
    <x-network.network-wrapper></x-network.network-wrapper>
    <br>
    <br>
    <br>

    <x-led.led></x-led.led>

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
