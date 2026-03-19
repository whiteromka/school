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

<x-ico-tech></x-ico-tech>

{{-- ========  ABOUT =========--}}
<div style="height: 80px"></div>
@include('components.nexus.about')
<div style="height: 150px"></div>

{{--  Контейнер преимущества  --}}
@include('components.cyber.advantages')

{{-- ====  Учебный процесс  ==== --}}
@include('components.nexus.learning-process-blocks')
<div style="height: 100px"></div>

{{--  FAQ на основе col из бутстрапа  --}}
@include('components.cyber.faq-slider')
<div style="height: 150px"></div>


<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">training</div>
            <h2 class="section-title">Чему учим</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>
<div class="container">
    <div>
        {{-- Табы --}}
        <ul class="nav nav-tabs cy-item-tabs fs-13" id="tech" role="tablist" style="display: flex; justify-content: center">
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
        <br>

        {{-- Таб контент --}}
        <div class="tab-content cy-item-tabs-content">
            <div class="tab-pane fade show active" id="web">
                {{-- Двойной контейнер с 3d визуализацией --}}
                <p class="grey">
                    В основном мы специализируемся на web технологиях фронтенд и бекенд.
                    Фронтенд - пользовательская часть приложения. Бекенд серверная сторона где хранятся данные и выполняется вся логика.
                    Так же у нас есть курс по gamedev(unity) и Английскому языку
                </p>
                <br>
                <x-cyber.perspective3d></x-cyber.perspective3d>
                <br>
                {{-- Контейнер network с технологиями --}}
                <x-network.network-wrapper></x-network.network-wrapper>
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
            <h2 class="section-title" >Тут конец...</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

{{-- Обычный двойной Контейнер --}}
@include('components.cyber.simple-double')
<div style="height: 150px"></div>

{{--  Отзывы  --}}
@include('components.nexus.reviews')

@include('components.footer-dark')
<br>
<br>
<br>

{{--<x-nexus></x-nexus>--}}
@endsection
