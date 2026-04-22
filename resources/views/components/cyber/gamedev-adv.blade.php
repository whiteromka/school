<div class="container">
    <h2 class="h2-common">
        почему Gamedev
    </h2>
</div>

<div class="container-fluid top-ark bg-light-grey_ bg-yellow_ bg-fantom px-0" style="background: #00708b">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>

<div class="container-fluid bg-light-grey_ bg-yellow_ bg-fantom_ bg-PHP px-0 pos-r">
    @include('components.cyber.matrix', ['css' => 'matrix-pos-tl'])
    <div class="container">

        <br>
        <br>
        <div class="row">
            <?php $advantages = [
                ['n'=>'01', 'name' => 'Мощный движок из коробки', 'descr' => 'Unity даёт готовую физику, рендеринг, UI, анимации и многое другое', 'type' => 'good'],
                ['n'=>'02', 'name' => 'C# — строгий и безопасный', 'descr' => 'Статическая типизация, меньше ошибок на этапе выполнения', 'type' => 'good'],
                ['n'=>'03', 'name' => 'Кроссплатформенность', 'descr' => 'Можно выпускать игры на ПК, мобильные устройства и консоли', 'type' => 'good'],
                ['n'=>'04', 'name' => 'Быстрый старт', 'descr' => 'Много готовых ассетов и туториалов, можно быстро собрать прототип', 'type' => 'good'],

                ['n'=>'05', 'name' => 'Сложность архитектуры', 'descr' => 'Крупные проекты быстро становятся сложными и требуют хорошей структуры', 'type' => 'bad'],
                ['n'=>'06', 'name' => 'Производительность', 'descr' => 'Unity уступает нативным решениям и требует оптимизации', 'type' => 'bad'],
                ['n'=>'07', 'name' => 'Долгие билды', 'descr' => 'Сборка проекта может занимать много времени', 'type' => 'bad'],
                ['n'=>'18', 'name' => 'Высокий порог в геймдеве', 'descr' => 'Нужно понимать не только код, но и геймдизайн, математику и оптимизацию', 'type' => 'bad'],
            ]; ?>

            @php $i = 0; @endphp
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-5 {{$i % 2 === 0 ? 'offset-xxl-1' : ''}} ">
                    <div>
                        <div class="advantage d-flex justify-content-center align-items-end" style="border: 1px solid rgba(245,245,245,0.48)">
                            <div class="{{ $advantage['type'] == 'good' ? 'bg-opas-dark' : 'bg-test' }}
                                js-cy-brackets d-flex align-items-center"
                                 data-color="red" data-width="2" data-size="8"
                            >
                                <div class="n {{ $advantage['type'] == 'good' ? 'n1' : '' }}">
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

<div class="container-fluid bottom-ark bg-light-grey_ bg-yellow_ bg-fantom px-0" style="background: #00708b">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>
<div style="height: 100px"></div>
