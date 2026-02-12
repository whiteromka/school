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
    <div class="container">
        <section class="section" id="about">
            <div class="section-header">
                <div class="section-label">About</div>
                <h2 class="section-title">System Overview</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
            <div class="info-grid">
                <div class="info-meta">
                    <div class="meta-item">
                        <div class="meta-label">Founded</div>
                        <div class="meta-value">20<span class="accent">19</span></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Location</div>
                        <div class="meta-value">Node.<span class="accent">NYC</span> / Node.<span class="accent">TKY</span></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Operatives</div>
                        <div class="meta-value"><span class="accent">48</span> Engineers</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Mode</div>
                        <div class="meta-value">ACTIVE_<span class="accent">DEPLOY</span></div>
                    </div>
                </div>
                <div class="info-body">
                    <p>
                        <span class="accent">NEXUS COLLECTIVE</span> operates at the intersection of advanced systems engineering and digital design. We architect neural networks, construct distributed platforms, and engineer cybernetic interfaces for organizations navigating the connected age.
                    </p>
                    <p>
                        Our operatives specialize in high-throughput data architectures, real-time processing systems, and human-machine interfaces that push the boundary between the organic and the digital. Every system we build is designed for <span class="accent">resilience, speed, and scale</span>.
                    </p>
                    <p>
                        From secure communications infrastructure to AI-driven analytics platforms, we deliver solutions that operate at the edge of what is technically possible.
                    </p>
                </div>
            </div>
        </section>
    </div>

    {{--  FAQ на основе col из бутстрапа  --}}
    <x-cyber.faq-col></x-cyber.faq-col>
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
