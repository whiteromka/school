@php
    /** @var string $userIp */
    /** @var array $activeModules */
@endphp

@extends('layouts.main')

@section('title', 'Групповые курсы по программированию')

@section('content')
{{-- Вступительный контейнер    --}}
@include('components.cyber.main-first', ['userIp' => $userIp])
<br>
<br>
<br>
<br>

@include('components.ico-tech')

{{-- ========  ABOUT =========--}}
<div style="height: 80px"></div>
@include('components.nexus.about')
<div style="height: 150px"></div>

{{--  Контейнер преимущества  --}}
@include('components.cyber.advantages')

{{-- ====  Учебный процесс  ==== --}}
@include('components.nexus.learning-process-blocks')
<div style="height: 60px"></div>

{{--  FAQ на основе col из бутстрапа  --}}
@include('components.cyber.faq-slider')
<div style="height: 150px"></div>


<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">What we teach</div>
            <h2 class="section-title">
                <span class="js-glitch" data-text="Чему учим">Чему учим</span>
            </h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

<div class="container info-body-bg p-clamp-1">
    {{-- Контейнер network с технологиями --}}
    @include('components.network.network-wrapper')
</div>
<div style="height: 50px"></div>

<div class="container px-0">
    <div>
        <ul class="nav nav-tabs cy-item-tabs fs-13 mb-0 px-0" id="tech" role="tablist" style="display: flex; justify-content: center">
            <li class="nav-item " role="presentation">
                <button class="nav-link active "
                        data-bs-toggle="tab"
                        data-bs-target="#web"
                        type="button">
                    web
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#foreign_language"
                        type="button">
                    English
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#gamedev"
                        type="button">
                    Gamedev
                </button>
            </li>
        </ul>

        {{-- Таб контент --}}
        <div class="tab-content cy-item-tabs-content info-body-bg pt-40 p-clamp-1">
            <div class="tab-pane fade show  active" id="web">
                <div>
                    <p class="grey fs-p">
                        В основном мы специализируемся на web технологиях фронтенд и бекенд.
                        Фронтенд - пользовательская часть приложения. Бекенд серверная сторона где хранятся данные и выполняется вся логика.
                        Так же у нас есть курс по gamedev(unity) и Английскому языку
                    </p>
                </div>
                <br>
                @include('components.cyber.perspective3d')
            </div>
            <div class="tab-pane fade" id="foreign_language">
                <p>тут про english</p>
            </div>
            <div class="tab-pane fade" id="gamedev">
                <p>тут про gamedev</p>
            </div>
        </div>
    </div>
</div>
<div style="height: 150px"></div>

{{-- Контейнер с курсами \ модулями (items)  --}}
@include('components.cyber.courses')
<div style="height: 60px"></div>

{{-- Вакансии --}}
@include('components.nexus.vacancies')
<div style="height: 150px"></div>

{{--@include('components.cyber.x2')--}}
@include('components.cyber.advantages2')
<div style="height: 150px"></div>

<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">finally...</div>
            <h2 class="section-title">
                <span class="js-glitch" data-text="В заключении">В заключении</span>
            </h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

<div class="hud-container_ container px-0">
    <!-- Range Region Area Header -->
    <div class="range-header">
        <div class="range-marker"></div>
        <span class="range-text">Warning Message Area</span>
        <div class="range-marker"></div>
    </div>

    <!-- Central Data Block -->
    <div class="row">
        <div class="col-sm-12">

            <div class="data-block">
                <div class="progress-markers">
                    <div class="progress-marker"></div>
                    <div class="progress-line-bottom"></div>
                    <div class="progress-marker"></div>
                </div>
                <div class="side-text side-left d-none d-md-block ls-10">||||||||||</div>
                <div class="side-text side-right d-none d-md-block ls-10">||||||||||</div>
                <div class="data-main">
                    {{--                        <span class="num-left">0147</span>--}}
                    <span class="num-inf">INFO</span>
                    {{--                        <span class="data-separator">.</span>--}}
                    {{--                        <span class="num-inf">WARN</span>--}}
                    {{--                        <span class="num-right">WARN</span>--}}
                </div>
                <div class="progress-markers">
                    <div class="progress-marker"></div>
                    <div class="progress-line-bottom"></div>
                    <div class="progress-marker"></div>
                </div>

                <!-- Loading Section -->
                <div class="loading-section mt-2">
                    <div class="loading-header_ ta-l">
                        <p class="loading-text-code1 ta-c">
                            <span class="pink2">
                                Всем поможем! Ни кого не бросим!
                            </span>
                        </p>
                        <p class="fs-15">
                            Формат занятий предполагает открытый и простой диалог. Друзья, не стесняйтесь
                            задавать вопросы и просить о помощи. Если что-то не поняли, забыли или упустили
                            просто попросите повторить. Просите больше примеров на интересующие вас темы:
                            мы достаточно гибкие, чтобы подстроиться прямо по ходу урока. Если застряли с
                            домашкой - просто попросите разобрать и объяснить ещё раз! Мы всегда идём
                            навстречу и обязательно поможем, никого не бросим. Все нужные и важные темы,
                            обозначенные в модуле, мы обязательно пройдём. Если потребуется, увеличим
                            количество уроков в модуле без доплаты.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Side Elements --}}
{{--    <div class="side-elements">--}}
{{--        <div class="side-element">--}}
{{--            <span class="side-number">22 42</span>--}}
{{--            <div class="side-grid">--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--            </div>--}}
{{--            <span class="side-number">22 42</span>--}}
{{--        </div>--}}

{{--        <div class="side-element">--}}
{{--            <span class="side-number">22 46</span>--}}
{{--            <div class="side-grid">--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--                <div class="grid-cell"></div>--}}
{{--                <div class="grid-cell active"></div>--}}
{{--            </div>--}}
{{--            <span class="side-number">47 35</span>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>



<div style="height: 150px"></div>

{{--  Отзывы  --}}
@include('components.nexus.reviews')
<br>
<br>
<br>

{{--<x-nexus></x-nexus>--}}
@endsection
