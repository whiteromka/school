@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
@endphp

@extends('layouts.main')

@section('title', 'Курсы по программированию на php')

@section('content')

    @include('components.nexus.hello-php')
    @include('components.cyber.php-adv2')

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
                            data-bs-target="#Популярный"
                            type="button">
                        Популярность
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#Простой"
                            type="button">
                        Простота
                    </button>
                </li>
            </ul>

            {{-- Таб контент --}}
            <div class="tab-content cy-item-tabs-content info-body-bg"
                 style="padding: clamp(10px, 5vw, 45px); border-left: 1px solid #00eaff">
                <div class="tab-pane fade show active" id="Рынок_труда">
                    <p>На российском рынке труда ситуация в области backend разработки складывается следующим образом:</p>
                    <br>
                    <p>
                        <span class="orange">Python</span> стал мейнстримом благодаря Data Science, ML и автоматизации.
                        Сейчас его учат в школах, колледжах и университетах. Все это привело к наводнению рынка
                        начинающими разработчиками, которые конкурируют за ограниченное количество позиций. Работодатели
                        могут позволить себе выбирать из сотен а, иногда и тысяч резюме откликнувшихся на вакансию, и часто завышают
                        требования.
                    </p>
                    <br>
                    <p>
                        <span class="orange">Go</span> привлекает внимание как современный, очень быстрый «язык от
                        Google», но
                        позиции для разработчиков начального уровня на Go крайне редки. Компании обычно ищут опытных
                        специалистов
                        пришедших в Go из других языков для работы с высоконагруженными системами, и предъявляют
                        высокие требования к таким специалистам.
                    </p>
                    <br>
                    <p>
                        <span class="orange">PHP</span> уровень конкуренции так же как и во всей отрасли остается
                        высоким,
                        но все же он значительно ниже чем в других языках программирования.
                        Спрос на PHP разработчиков остаётся благодаря огромному
                        количеству уже существующих проектов, которые нуждаются в поддержке и развитии.
                        Компании готовы брать PHP-разработчиков, потому что:
                        PHP-кодовая база огромна и требует постоянного расширения команды.
                        Стоимость интеграции нового программиста в разработку невелика благодаря простоте языка.
                        И результат работы php разработчика виден быстро.
                    </p>

                </div>
                <div class="tab-pane fade" id="Популярный">
                    <p><span class="orange">PHP</span> — это не просто «старый» язык, а технологический фундамент, на
                        котором
                        держится большая часть цифрового мира. По данным на сегодняшний день, около 75% всех веб-сайтов
                        в интернете
                        работают на PHP. Это означает, что каждый раз, когда вы открываете популярный сайт — будь то
                        социальная сеть,
                        интернет-магазин или новостной портал — с высокой вероятностью вы взаимодействуете с PHP-кодом.
                    </p>
                    <br>
                    <p>
                        Такая массовая распространённость гарантирует, что знание <span class="orange">PHP</span>
                        открывает двери
                        к огромному количеству проектов и рабочих мест. В отличие от нишевых технологий, PHP-разработчик
                        всегда будет востребован,
                        потому что поддерживать и развивать существующую инфраструктуру нужно постоянно.
                    </p>
                    <br>
                    <p>Ниже различные рейтинги языков программирования:</p>
                    <a href="https://www.opennet.ru/opennews/art.shtml?num=64135" target="_blank">opennet.ru</a>,
                    <a href="https://habr.com/ru/companies/selectel/articles/951348/" target="_blank">habr.com</a>,
                    <a href="https://www.tiobe.com/tiobe-index/" target="_blank">tiobe.com</a>,
                    <a href="https://journal.sovcombank.ru/obuchenie/kakie-yaziki-programmirovaniya-budut-vostrebovani#h_24855822511737673974105"
                       target="_blank">sovcombank.ru</a>,
                    <a href="https://rb.ru/stories/most-in-demand-languages/" target="_blank">rb.ru</a>
                </div>

                <div class="tab-pane fade" id="Простой">
                    <p>Одно из главных преимуществ <span class="orange">PHP</span> — его низкий порог входа. Синтаксис
                        языка
                        интуитивно понятен, особенно если у вас есть базовые знания HTML. Вы можете написать первую
                        работающую
                        программу буквально через несколько часов после начала обучения. Не требует сложной настройки
                        окружения,
                        можно сразу начинать экспериментировать и писать проекты. Код выполняется последовательно, что
                        делает
                        логику программы прозрачной и предсказуемой для новичка. Эта простота позволяет сосредоточиться
                        на
                        изучении фундаментальных концепций программирования, а не тратить месяцы на освоение сложной
                        инфраструктуры языка.
                    </p>
                    <br>
                    <p>Важно отметить, что простота <span class="orange">PHP</span> имеет и обратную сторону — на
                        сопоставимых позициях зарплатный потолок PHP-разработчиков, как правило, чуть ниже, чем у
                        специалистов по Java или Go.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 150px"></div>

    @include('components.nexus.php-blocks', ['modules' => $modules, 'userModuleIds' => $userModuleIds])

    <div class="container">
        <br>
        <div class="ta-r">
            <p>Преподаватель модулей: <a href="#">Roman Belov</a></p>
        </div>
    </div>

    <div class="container">
        @include('components.cyber.teacher')
    </div>

    <div style="height: 150px"></div>

{{--    @include('components.footer-dark')--}}
@endsection
