@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
@endphp

@extends('layouts.main')

@section('title', 'Курсы по программированию на Java Script')

@section('content')

    @include('components.nexus.hello-js')
    @include('components.cyber.js-adv')

    <div class="container">
        <div class="cy-item-tabs-wrap_ ">
            {{-- Табы --}}
            <ul class="nav nav-tabs cy-item-tabs fs-13 mb-0" id="tech" role="tablist"
                style="display: flex; justify-content: center">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#Рынок_труда"
                            type="button">
                        Рынок труда
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#Универсальность"
                            type="button">
                        Универсальность
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#Экосистема"
                            type="button">
                        Экосистема
                    </button>
                </li>
            </ul>

            {{-- Таб контент --}}
            <div class="tab-content cy-item-tabs-content info-body-bg"
                 style="padding: clamp(10px, 5vw, 45px); border-left: 1px solid #00eaff">
                <div class="tab-pane fade show active" id="Рынок_труда">
                    <p>
                        Высокая популярность языка играет и обратную роль - <span class="orange">JavaScript</span> чаще всего выбирают
                        новички, поэтому конкуренция на начальном уровне заметно выше, чем в других направлениях. На
                        одну junior-позицию может приходиться большое количество кандидатов, и работодатели начинают
                        обращать внимание не только на базовые знания, но и на практический опыт, понимание архитектуры
                        и умение работать с современными инструментами. В итоге язык остаётся сильным выбором, но для
                        успешного старта важно быть сильнее среднего уровня, чтобы выделиться на фоне других
                        кандидатов.
                    </p>
                </div>
                <div class="tab-pane fade" id="Универсальность">
                    <p><span class="orange">JavaScript</span> - это язык, который фактически стал стандартом для
                        веб-разработки. Он работает прямо в браузере, позволяя создавать интерактивные интерфейсы без
                        установки дополнительного ПО. При этом его возможности давно вышли за рамки фронтенда: с помощью
                        Node.js можно писать серверную часть, а с фреймворками вроде Vue.js — строить полноценные
                        SPA-приложения. В результате один язык покрывает сразу несколько областей разработки, что делает
                        его особенно удобным для старта и роста.
                    </p>
                    <br>
                </div>

                <div class="tab-pane fade" id="Экосистема">
                    <p>Одним из главных преимуществ <span class="orange">JavaScript</span> является его огромная экосистема. Репозиторий npm
                        содержит сотни тысяч готовых библиотек, которые позволяют решать типовые задачи за считанные
                        минуты. Это существенно ускоряет разработку и снижает необходимость писать всё с нуля. Благодаря
                        активному сообществу язык постоянно развивается, а новые инструменты и подходы появляются
                        быстрее, чем в большинстве других технологий.
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 150px"></div>

    @include('components.nexus.js-blocks', ['modules' => $modules, 'userModuleIds' => $userModuleIds])

    <div class="container">
        <br>
        <div class="ta-r">
            <p>Преподаватель модулей: <a href="#">Roman Belov</a></p>
        </div>
    </div>

    <div class="container">
        <div class="persp-1600">
            <div class="custom-block_persp" style="max-width: 280px;">
                <div class="trapezoid-bottom_persp"></div>
                <div class="php-custom-block-content_persp ta-c" style="min-height: 180px">
                    <img src="http://localhost:8080/img/site/fly_red.jpeg" class="img-fluid" alt="">
                    <p class="php-custom-block-help_persp">преподаватель:</p>
                    <a href="#" class="php-custom-block-head_persp">Roman Belov</a>
                </div>
                <div class="trapezoid-top_persp"></div>
            </div>
        </div>
    </div>

    <div style="height: 150px"></div>
@endsection
