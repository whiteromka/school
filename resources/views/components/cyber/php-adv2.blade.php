<div class="container">
    <h2 class="h2-common">
{{--         <span>PHP</span>--}}
        почему php
    </h2>
</div>

<div class="container-fluid top-ark bg-light-grey px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>

<div class="container-fluid bg-light-grey px-0 pos-r">
    @include('components.cyber.matrix', ['css' => 'matrix-pos-tl'])
    @include('components.cyber.x-text', [
        'main' => 'PHP',
        'mainSpan' => '>>> ||',
        'descr' => 'SYS modules XXX'
    ])

    <div class="container">
        <div style="height: 60px"></div>
        <div class="row">
            <?php $advantages = [
                ['n'=>'01', 'name' => 'Максимально быстрый вход', 'descr' => 'Порог входа низкий: можно быстро начать писать полезный код. Простая модель: запрос - скрипт - ответ', 'type' => 'good'],
                ['n'=>'02','name' => 'Огромная экосистема веба', 'descr' => 'Исторически ~70–75% сайтов. Много готовых решений. Фреймворки Laravel, Symfony, Yii2', 'type' => 'good'],
                ['n'=>'03','name' => 'Дешёвый и простой деплой', 'descr' => 'Хостинг есть везде. Не требует сложной инфраструктуры', 'type' => 'good'],
                ['n'=>'04','name' => 'Меньший уровень конкуренции', 'descr' => 'Меньше хайпа вокруг php. Проще найти работу', 'type' => 'good'],
                ['n'=>'05','name' => 'Исторический багаж', 'descr' => '"Плохие практики" из прошлого. Код-базы часто превращаются в легаси', 'type' => 'bad'],
                ['n'=>'06','name' => 'Узкая специализация', 'descr' => 'Язык для web разработки', 'type' => 'bad'],
            ]; ?>

            @php $i = 0; @endphp
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-5 {{$i % 2 === 0 ? 'offset-xxl-1' : ''}} ">
                    <div>
                        <div class="advantage d-flex justify-content-center align-items-end">
                            <div class="{{ $advantage['type'] == 'good' ? 'bg-opas-dark' : 'bg-test' }}
                            js-cy-brackets d-flex align-items-center" data-color="red" data-width="2" data-size="8"
                            >
                                <div class="n">
                                    <span> {{ $advantage['n'] }} </span>
                                </div>
                                <div style="width: 70%">
                                    <span class="name ta-c"> {{ $advantage['name'] }} </span>
                                </div>
                            </div>
                        </div>
                        <p class="p-lr-10 {{ $advantage['type'] == 'good' ? 'advantage-descr' : 'advantage-descr-red' }}"> {!! $advantage['descr'] !!}  </p>
                    </div>
                </div>
                @php $i++; @endphp
            @endforeach

        </div>
        <div style="height: 80px"></div>
    </div>
</div>

<div class="container-fluid bottom-ark bg-light-grey px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>
<div style="height: 100px"></div>
