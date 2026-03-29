<div class="container">
    <h2 class="h2-common">
        почему Java Script
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
    'main' => 'JS',
    'mainSpan' => '>>> ||',
    'descr' => 'SYS modules XXX'
    ])

    <div class="container">
        <div style="height: 60px"></div>
        <div class="row">
            <?php $advantages = [
                ['n'=>'01', 'name' => 'Единственный язык фронтенда', 'descr' => 'В браузере без него никак', 'type' => 'good'],
                ['n'=>'02', 'name' => 'Fullstack', 'descr' => 'На одном языке можно писать сразу и бек и фронт', 'type' => 'good'],
                ['n'=>'03', 'name' => 'Огромная экосистема', 'descr' => 'npm - крупнейший пакетный репозиторий', 'type' => 'good'],
                ['n'=>'04', 'name' => 'Асинхронность из коробки', 'descr' => 'Promises / async-await', 'type' => 'good'],
                ['n'=>'05', 'name' => 'Слишком гибкий', 'descr' => 'Много хаоса. Легко писать плохой код. Нет строгой типизации(без TS)', 'type' => 'bad'],
                ['n'=>'06', 'name' => 'Высокий уровень конкуренции', 'descr' => 'Большое количество разработчиков пишут на JS. Высокая конкуренция за рабочие места', 'type' => 'bad'],
            ]; ?>

            @php $i = 0; @endphp
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-5 {{$i % 2 === 0 ? 'offset-xxl-1' : ''}} ">
                    <div>
                        <div class="advantage d-flex justify-content-center align-items-end">
                            <div class="{{ $advantage['type'] == 'good' ? 'bg-opas-dark' : 'bg-test' }}
                                js-cy-brackets d-flex align-items-center"
                                 data-color="red" data-width="2" data-size="8"
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
