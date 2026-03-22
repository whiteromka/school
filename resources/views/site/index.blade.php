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
            <h2 class="section-title" >В заключении</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
    </section>
</div>

{{-- Обычный двойной Контейнер --}}
{{--@include('components.cyber.simple-double')--}}

<div class="container">
    <div class="row">

        <div class="col-12">
            <div class="js-cy-brackets" data-color="white" data-width="1" data-size="10" style="padding: 5px">

                <div class="bottom-main">

                    <div class="deco-cube-40 top-10 right-10"></div>
                    <br>
                    <div class="row" style="border: 1px solid #070707; border-right: none ">
                        <p></p>
                        <div class="col-4" style="display: flex; flex-direction: column;">
                            <div class="ta-c js-cy-brackets" data-color="white" data-size="8" data-width="8"
                                 style="height: 100%;"
                            >
                                <br><br>
                                <h2 style="color: black; font-family: 'Tektur', sans-serif">НЕ ОБМАНЫВАЕМ<br>И НЕ БРОСАЕМ</h2>
                                <br><br>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="js-cy-brackets container-t " data-color="white" style="padding: 4px">
                                <div style="

                                /*background-image:*/
                                /*  repeating-linear-gradient(45deg,*/
                                /*    rgba(0,0,0,0.13) 4px,  rgba(0,0,0,0.93) 2px,*/
                                /*    rgba(0,0,0,0.20) 5px,  rgba(0,0,0,0.20) 10px);*/
                                /*background-size: 6px 6px;*/


                                padding: 10px 40px">
                                    <br>
                                    <p style="color: #a2a2a2; font-size: 15px; letter-spacing: 1px; line-height: 1;">Кто мы такие?
                                        Честно? Маленькая команда энтузиастов. Без офиса в Москва-Сити, без рекламы на ТВ и без громких имён в инвесторах.
                                        Зато у нас есть:
                                        15 лет коммерческого опыта на двоих Желание сделать реально крутой продукт Понимание, что каждый студент важен и это наша репутация
                                        Мы не строим из себя гуру. Мы просто показываем, что умеем сами и как сейчас пишут приложения в компания.
                                        Помогаем повторить. Если ты хочешь, чтобы тебя вели за ручку, но при этом уважали — нам по пути.
                                    </p>
                                </div>

                            </div>
                        </div>
                        <p></p>
                    </div>

                </div>
                <div class="bottom-main-footer" style="margin-top: -1px"></div>

            </div>
        </div>

{{--        <div class="col-12 col-md-6">--}}
{{--            <div class="custom-block mt-1">--}}
{{--                <div class="trapezoid-bottom"></div>--}}
{{--                <div class="php-custom-block-content ta-c" style="min-height: 190px">--}}
{{--                    <p class="php-custom-block-head" id="js-techStack">МЫ НЕ ОБМАНЫВВАЕМ И НЕ НИКОГО НЕ БРОСАЕМ</p>--}}
{{--                    <br>--}}
{{--                    <p class="php-custom-block-text ta-l">--}}
{{--                        Кто мы такие?--}}
{{--                        Честно? Маленькая команда энтузиастов. Без офиса в Москва-Сити, без рекламы на ТВ и без громких имён в инвесторах.--}}
{{--                        Зато у нас есть:--}}
{{--                        15 лет коммерческого опыта на двоих Желание сделать реально крутой продукт Понимание, что каждый студент важен и это наша репутация--}}
{{--                        Мы не строим из себя гуру. Мы просто показываем, что умеем сами и как сейчас пишут приложения в компания. Помогаем повторить. Если ты хочешь, чтобы тебя вели за ручку, но при этом уважали — нам по пути.</p>--}}
{{--                    <br>--}}
{{--                </div>--}}
{{--                <div class="trapezoid-top"></div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
</div>

<div style="height: 150px"></div>

{{--  Отзывы  --}}
@include('components.nexus.reviews')

@include('components.footer-dark')
<br>
<br>
<br>

{{--<x-nexus></x-nexus>--}}
@endsection
