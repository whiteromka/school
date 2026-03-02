<div class="container">
    <h2 class="h2-common">
       почему php
    </h2>
</div>

<div class="container-fluid top-ark bg-pink px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>
<div class="container-fluid bg-pink px-0" style="height: 5px">
</div>

<div class="container-fluid bg-pink_ px-0" style="background: rgba(85,85,85,0.09)">
    <x-cyber.matrix></x-cyber.matrix>

    <div class="container">
        <br> <br>
        <div class="row">
            <?php $advantages = [
                ['name' => 'Популярный', 'descr' => 'Один из самых популярных языков программирования в РФ! 75% всего интернета в МИРЕ написано на PHP'],
                ['name' => 'Простой', 'descr' => 'Низкий порог входа. Очень простой язык в сравнении с C++, GO и Java'],
                ['name' => 'Наглядный', 'descr' => 'Имея самые базовые знания можно начать писать свое приложение'],
                ['name' => 'Проверенный', 'descr' => 'PHP настоящий титан IT индустрии. Первая версия языка вышла в 1995. Крайняя версия языка вышла в ноябре 2025'],
            ]; ?>
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div>

                        <div class="custom-block mt-1">
                            <div class="trapezoid-bottom"></div>
                            <div class="php-custom-block-content ta-c" style="min-height: 190px">
                                <p class="login-form-text_" style="border-left: 1px solid #00eaff; background: rgba(0,255,242,0.06); color: #ffffff; padding: 5px;">{{ $advantage['name'] }}</p>
                                <p class="php-custom-block-text">{!! $advantage['descr'] !!}</p>
{{--                                <a href="https://oauth.yandex.ru/authorize?response_type=code&amp;client_id=ce07d933a8244174a2a41327cc61428b" class="btn btn-s btn--primary" id="loadMoreVacancies" data-offset="6">--}}
{{--                                    <span class="btn__content">Yandex</span>--}}
{{--                                    <span class="btn__glitch"></span>--}}
{{--                                    <span class="btn__label">xv-003</span>--}}
{{--                                </a>--}}
                            </div>
                            <div class="trapezoid-top"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <br> <br> <br>
        </div>
    </div>
</div>

<div class="container-fluid bg-pink px-0">
    <br>
</div>
<div class="container-fluid bottom-ark bg-pink px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>

<div style="height: 100px"></div>

