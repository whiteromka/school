<div class="container">
    <h2 class="h2-common">
       Что получите по итогу
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

<div class="container-fluid red-container bg-pink_ px-0">
    <x-cyber.matrix></x-cyber.matrix>

    <div class="container">
        <br>
        <div class="row">
            <?php $advantages = [
                ['name' => 'Знания и навыки', 'descr' => 'Понимание принципов на которых строится все программирование'],
                ['name' => 'Опыт', 'descr' => 'Опыт решения задач junior-middle уровня с учетом актуальных практик'],
                ['name' => 'Проекты в портфолио', 'descr' => 'После прохождения модуля у вас останется проект который можно добавить в свое портфолио'],
                ['name' => 'Сертификат', 'descr' => 'Именной электронный сертификат о прохождении модуля. <a href="#">Сертификат</a> '],
            ]; ?>
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div>

                        <div class="custom-block mt-1">
                            <div class="trapezoid-bottom"></div>
                            <div class="php-custom-block-content ta-c" style="min-height: 190px">
                                <p class="php-custom-block-head">{{ $advantage['name'] }}</p>
                                <p class="php-custom-block-text">{!! $advantage['descr'] !!}</p>
                            </div>
                            <div class="trapezoid-top"></div>
                        </div>
                    </div>
                </div>
            @endforeach
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

