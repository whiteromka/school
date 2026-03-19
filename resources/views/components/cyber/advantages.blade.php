<div class="container">
    <h2 class="h2-common">
{{--        <span>0.01</span> <br>--}}
        Что мы предлагаем
    </h2>
</div>

<div class="container-fluid top-ark bg-yellow px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>

<div class="container-fluid bg-yellow px-0">

{{--    <x-telegram.login></x-telegram.login>--}}

    @include('components.cyber.matrix', ['css' => 'matrix-pos-tl'])

    <div class="container">
        <div class="row">
            <?php
            $advantages = [
                ['n' => '01', 'name' => 'Можно начать с нуля', 'descr' => 'Есть вступительные и модули для новичков совсем без опыта'],
                ['n' => '02', 'name' => 'Пошаговое обучение', 'descr' => 'От простого к сложному. Все обучение разбито на модули'],
                ['n' => '03', 'name' => 'Модульная система', 'descr' => 'Выбирайте только нужные вам модули курса'],
                ['n' => '04', 'name' => 'Групповые занятия', 'descr' => 'Онлайн занятия с опытным специалистом. В группе с вами студенты со схожим опытом'],
                ['n' => '05', 'name' => 'Проверенные технологии', 'descr' => '<b>PHP</b>, <b>С#</b> и <b>JavaScript</b> - регулярно попадают в топ 10 языков программирования в РФ'],
                ['n' => '06', 'name' => 'Наставники из индустрии', 'descr' => 'Преподаватели работают в IT-компаниях, а не только преподают'],
                ['n' => '07', 'name' => 'Code review', 'descr' => 'Проверка кода преподавателем с разбором ошибок'],
                ['n' => '08', 'name' => 'Адекватные цены', 'descr' => 'Стоимость занятия от 400 руб за 1.5 часа'],
            ];
            ?>
            @php $i = 0; @endphp
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-5 {{$i % 2 === 0 ? 'offset-xxl-1' : ''}} ">
                <div>
                    <br>
                    <br>
                    <div class="advantage d-flex justify-content-center align-items-end">
                        <div class="js-cy-brackets bg-opas-dark d-flex  align-items-center" data-color="red" data-width="2" data-size="8">
                            <div class="n n1">
                                <span> {{ $advantage['n'] }} </span>
                            </div>
                            <div style="width: 70%">
                                <span class="name name1 ta-c"> {{ $advantage['name'] }} </span>
                            </div>
                        </div>
                    </div>
                    <p class="advantage-descr p-lr-10"> {!! $advantage['descr'] !!}  </p>
                </div>
            </div>
            @php $i++; @endphp
            @endforeach
        </div>
        <div class="row">
            <br> <br> <br>
        </div>
    </div>

    @include('components.cyber.matrix', ['css' => 'matrix-pos-bl'])
</div>

<div class="container-fluid bottom-ark bg-yellow px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>

