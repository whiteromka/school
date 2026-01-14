<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">--}}
</head>
<body>

<div class="container-fluid px-0">
    <div class="site-header">
        <div class="header-monitor">
          <x-led></x-led>
        </div>
    </div>
</div>
<div class="container-fluid bgd mh-800">
    <div class="site-content">
        @yield('content')
    </div>
</div>
{{--<script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>--}}
</body>
</html>
