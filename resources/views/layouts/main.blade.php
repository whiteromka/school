@php use App\Models\Vacancy; @endphp
<?php
/** @var Vacancy[] $vacancies */
/** @var string $userIp */
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{--  Для локалки  --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--  Для прода  --}}
    {{--    <link rel="stylesheet" href="https://6d7680a963ab0e9a-85-172-168-90.serveousercontent.com/build/assets/app-Dci0zQ8b.css">--}}
    {{--    <script type="module" src="https://6d7680a963ab0e9a-85-172-168-90.serveousercontent.com/build/assets/app-1APHx-Ru.js"></script>--}}
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

    <x-ico-tech></x-ico-tech>

    {{--  Контейнер преимущества  --}}
    <x-cyber.advantages></x-cyber.advantages>
    <br>
    <br>
    <br>
    <br>

    {{-- ========  ABOUT =========--}}
    <x-nexus.about></x-nexus.about>

    {{--  FAQ на основе col из бутстрапа  --}}
    <x-cyber.faq-col></x-cyber.faq-col>
    <br>
    <br>


    {{-- Двойной контейнер с 3d визуализацией --}}
    <x-cyber.perspective3d></x-cyber.perspective3d>
    <br>
    <br>

    {{-- Контейнер network с технологиями --}}
    <x-network.network-wrapper></x-network.network-wrapper>
    <br>
    <br>
    <br>


    {{-- Контейнер с курсами \ модулями (items)  --}}
    <x-cyber.items></x-cyber.items>
    <br>
    <br>

    <x-nexus.vacancies></x-nexus.vacancies>


    {{-- Обычный двойной Контейнер --}}
    <x-cyber.simple-double></x-cyber.simple-double>
    <br>
    <br>
    <br>
    <br>


    <x-footer-dark></x-footer-dark>
    {{--    <x-footer></x-footer>--}}
    <br>
    <br>
    <br>


    <x-nexus></x-nexus>

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
