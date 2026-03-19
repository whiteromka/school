<div class="container">
    <h2 class="h2-common">
{{--         <span>PHP</span> --}}
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
    'main' => 'XXXX PHP',
    'mainSpan' => '>>>',
    'descr' => 'SYS ++++ xxx'
    ])

    <div class="container">
        <div class="row">

            <?php $advantages = [
                ['n'=>'01', 'name' => 'Популярный', 'descr' => 'Один из самых популярных языков программирования в РФ! 75% всего интернета в МИРЕ написано на PHP'],
                ['n'=>'02', 'name' => 'Простой', 'descr' => 'Низкий порог входа. Очень простой язык в сравнении с C++, GO и Java'],
                ['n'=>'03', 'name' => 'Наглядный', 'descr' => 'Имея самые базовые знания можно начать писать свое приложение'],
                ['n'=>'04', 'name' => 'Проверенный', 'descr' => 'PHP настоящий титан IT индустрии. Первая версия языка вышла в 1995. Крайняя версия языка вышла в ноябре 2025'],
            ]; ?>

            @php $i = 0; @endphp
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-5 {{$i % 2 === 0 ? 'offset-xxl-1' : ''}} ">
                    <div>
                        <br>
                        <br>
                        <div class="advantage d-flex justify-content-center align-items-end">
                            <div class="js-cy-brackets bg-opas-dark d-flex  align-items-center" data-color="red" data-width="2" data-size="8">
                                <div class="n">
                                    <span> {{ $advantage['n'] }} </span>
                                </div>
                                <div style="width: 70%">
                                    <span class="name ta-c"> {{ $advantage['name'] }} </span>
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
