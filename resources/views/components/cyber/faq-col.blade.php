<div class="container">

    <div class="slider-wrapper">
        <div class="slider-header">
            <h1>FAQ</h1>
            <p>Вопросы и ответы по учебному процессу и не только</p>
        </div>

        <?php
            $items = [
                [
                    'col' => 'col-6',
                    'q' => 'Что такое CSS Grid и чем он отличается от Flexbox?',
                    'a' => 'CSS Grid — это двумерная система макетов, позволяющая работать со строками и столбцами одновременно.
                    Flexbox — одномерная система, ориентированная либо на строки, либо на колонки. Grid идеален для сложных
                    макетов страниц, а Flexbox лучше подходит для выравнивания элементов внутри компонентов.'
                ],
                [
                    'col' => 'col-4',
                    'q' => 'Зачем нужны семантические теги в HTML?',
                    'a' => 'Семантические теги делают код понятнее для разработчиков и поисковых систем. Они улучшают доступность для скринридеров и повышают SEO-оптимизацию сайта. Примеры: header, nav, article, section, footer.'
                ],
                [
                    'col' => 'col-2',
                    'q' => 'Что такое HTTP/3?',
                    'a' => 'HTTP/3 — третья версия протокола HTTP, использующая QUIC вместо TCP. Обеспечивает более быструю загрузку за счет уменьшения задержек и улучшенной безопасности.'
                ],
                [
                    'col' => 'col-6',
                    'q' => 'Как работает асинхронность в JavaScript?',
                    'a' => 'Асинхронность позволяет выполнять код без блокировки основного потока. Современные подходы: Promise для отложенных операций, async/await для синхронного написания асинхронного кода, Web Workers для многопоточности.'
                ],
                [
                    'col' => 'col-6',
                    'q' => 'В чем преимущество TypeScript перед JavaScript?',
                    'a' => 'Hooks — функции в React, позволяющие использовать состояние и другие возможности без написания классов. Основные хуки: useState, useEffect, useContext, useReducer.'
                ]
            ];
        ?>

        <div class="slider-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @foreach($items as $k => $v)
                    <div class="swiper-slide {{ $v['col'] }}">
                        <div class="qa-card">
                            <div class="qa-card-inner">
                                <div class="question">
                                    <span class="question-icon">?</span>
                                    <span> {{ $v['q'] }} </span>
                                </div>
                                <div class="answer">{{ $v['a'] }} </div>
                                <div class="card-number">{{$k + 1}}/{{count($items)}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="swiper-pagination swiper-pagination-progressbar"></div>
        </div>
        <div class="hover-hint">Наведите для паузы • Перетаскивайте для прокрутки</div>
    </div>

</div>
