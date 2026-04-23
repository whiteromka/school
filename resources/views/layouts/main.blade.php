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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- Фон из сетки квадратов --}}
<div class="grid-background" id="gridBackground"></div>

{{--Основной контейнер для контента--}}
<div class="container-fluid mt-10vh px-0 main-container">
    @include('components.nexus.navigation')

    <div class="main">
        @yield('content')
    </div>

    @include('components.nexus.footer')
</div>

@livewireScripts
@stack('scripts')

</body>
</html>
