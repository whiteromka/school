@php
    /** @var string $userIp */
@endphp

@extends('layouts.main')

@section('title', 'Групповые курсы по программированию')

@section('content')
{{-- Вступительный контейнер    --}}
<x-cyber.main-first :userIp="$userIp"></x-cyber.main-first>
<br>
<br>
<br>
<br>

<x-ico-tech></x-ico-tech>

<x-nexus.blocks></x-nexus.blocks>


{{--  Контейнер преимущества  --}}
<x-cyber.advantages></x-cyber.advantages>
<br>
<br>
<br>
<br>
<br>

{{-- ========  ABOUT =========--}}
<x-nexus.about></x-nexus.about>
<br>
<br>
<br>
<br>
<br>

{{--  FAQ на основе col из бутстрапа  --}}
<x-cyber.faq-slider></x-cyber.faq-slider>
<div style="height: 150px"></div>


<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">training</div>
            <h2 class="section-title" >Чему учим</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>

    <p style="font-size: 15px; color: #646464">
        В основном мы специализируемся на web технологиях фронтенд и бекенд.
        Фронтенд - пользовательская часть приложения. Бекенд серверная сторона где хранятся данные и выполняется вся логика.
        Так же у нас есть курс по gamedev(unity) и Английскому языку
    </p>
</div>

<div class="container">

    <div class="php-tabs-wrapper_">
        {{-- Табы --}}
            <ul class="nav nav-tabs cy-item-tabs fs-13" id="tech" role="tablist">
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
<div style="height: 120px"></div>


{{-- Контейнер с курсами \ модулями (items)  --}}
<x-cyber.courses></x-cyber.courses>
<br>
<br>


<x-nexus.vacancies></x-nexus.vacancies>
<br>
<br>
<br>

<x-cyber.x2></x-cyber.x2>
<br>
<br>
<br>
<br>


<div class="container">
    <section class="section_" id="about">
        <div class="section-header">
            <div class="section-label">finaly...</div>
            <h2 class="section-title" >Тут конец...</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

{{-- Обычный двойной Контейнер --}}
<x-cyber.simple-double></x-cyber.simple-double>
<br>
<br>
<br>
<br>

<x-footer-dark></x-footer-dark>
<br>
<br>
<br>

<x-nexus></x-nexus>
@endsection
