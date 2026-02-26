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

    <x-cyber.matrix></x-cyber.matrix>

    <div class="container">
        <div class="row">
            <?php $advantages = [
                ['name' => 'Пошаговое обучение','descr' => 'От простого к сложному. Все обучение разбито на модули'],
                ['name' => 'Групповые занятия', 'descr' => 'Онлайн занятия с опытным <a href="#">специалистом</a>. В группе с вами студенты со схожим опытом'],
                ['name' => 'Можно начать с нуля', 'descr' => 'Есть вступительные и модули для новичков совсем без опыта'],
                ['name' => 'Наставники из индустрии', 'descr' => 'Преподаватели работают в IT-компаниях, а не только преподают'],
                ['name' => 'Проверенные технологии' , 'descr' => '<b>PHP</b> и <b>JavaScript</b> - регулярно попадают в топ-10 языков программирования в РФ'],
                ['name' => 'Модульная система' , 'descr' => 'Выбирайте только нужные вам модули курса'],
                ['name' => 'Code review', 'descr' => 'Проверка кода преподавателем с разбором ошибок'],
                ['name' => 'Адекватные цены', 'descr' => 'Стоимость занятия от 400 руб за 1.5 часа'],
            ];?>
            @foreach($advantages as $advantage)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div>
                    <br>
                    <br>
                    <div class="advantage">
                        <div class="js-cy-brackets bg-opas-dark_" data-color="red" data-width="2" data-size="8">
                            <span> {{ $advantage['name'] }} </span>
                        </div>
                    </div>
                    <p class="advantage-descr p-lr-10"> {!! $advantage['descr'] !!}  </p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <br> <br> <br>
        </div>
    </div>
</div>

<div class="container-fluid bottom-ark bg-yellow px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>

