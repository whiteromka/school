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
<div style="height: 60px"></div>

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
                <div class="container_ ">
                    <p class="grey">
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
            <div class="js-cy-brackets p-5" data-color="white" data-width="1" data-size="10">

                <div class="bottom-main-head">
                    <div class="deco-cube-40 top-10 right-10"></div>
                </div>
                <div class="bottom-main">
                    <div class="row" style="border: 1px solid #070707; border-right: none">
                        <div class="col-12 col-md-4 d-flex flex-column mt-10">
                            <div class="ta-c js-cy-brackets" data-color="white" data-size="8" data-width="8"
                                 style="height: 100%;"
                            >
                                <br>
                                <br>
                                <h2>ВСЕМ ПОМОЖЕМ<br>НИ КОГО НЕ БРОСИМ</h2>
                                <br>
                                <br>
                            </div>
                        </div>

                        <div class="col-12 col-md-8 mt-10">
                            <div class="js-cy-brackets container-t" data-color="white" style="padding: 4px">
                                <div class="p-clamp-1">
                                    <p>
                                        Формат занятий предполагает открытый и простой диалог. Друзья, не стесняйтесь задавать вопросы и просить о помощи.
                                        Если что-то не поняли, забыли или упустили просто попросите повторить.
                                        Просите больше примеров на интересующие вас темы: мы достаточно гибкие, чтобы подстроиться прямо по ходу урока.
                                        Если застряли с домашкой - просто попросите разобрать и объяснить ещё раз!
                                        Мы всегда идём навстречу и обязательно поможем, никого не бросим.
                                        Все нужные и важные темы, обозначенные в модуле, мы обязательно пройдём.
                                        Если потребуется, увеличим количество уроков в модуле без дополнительной оплаты.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p></p>
                    </div>

                    <div class="row mt-10">
                        <div class="col-12 px-1_ d-flex justify-content-start" style="padding-left: 14px">
                            <a class="item-btn-wrapper p-lr-10" href="http://localhost:8080/site/back">
                                <div class="item-btn js-cyber-text-animation bg-white"><span data-target="П">0</span><span data-target="о">L</span><span data-target="д">N</span><span data-target="р">!</span><span data-target="о">U</span><span data-target="б">X</span><span data-target="н">O</span><span data-target="е">8</span><span data-target="е">B</span></div>
                            </a>
{{--                            <button class="btn btn-s btn--secondary" id="loadMoreVacancies-php" data-offset="6" data-type="PHP">--}}
{{--                                <span class="btn__content">Еще PHP вакансии</span>--}}
{{--                                <span class="btn__glitch"></span>--}}
{{--                                <span class="btn__label">r25</span>--}}
{{--                            </button>--}}
                        </div>
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
