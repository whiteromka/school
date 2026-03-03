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
<div class="container-fluid mt-10vh px-0 main-container">

    <x-nexus.navigation></x-nexus.navigation>

    <div class="main">
        @yield('content')
    </div>

    <x-nexus.footer></x-nexus.footer>
</div>


@stack('scripts')
</body>
</html>
