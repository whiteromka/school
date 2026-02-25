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

<div class="container-fluid bg-pink px-0">
    <x-cyber.matrix></x-cyber.matrix>

    <div class="container">
        <br>
        <div class="row">
            <?php $advantages = [
                ['name' => 'Знания и навыки', 'descr' => 'Понимание принципов на которых строится все программирование'],
                ['name' => 'Опыт', 'descr' => 'Опыт решения боевых задач'],
                ['name' => 'Проекты в портфолио', 'descr' => 'После прохождения модуля у вас останется проект который можно добавить в свое портфолио'],
                ['name' => 'Сертификат', 'descr' => 'Именной электронный сертификат о прохождении модуля. <a href="#">Сертификат</a> '],
            ]; ?>
            @foreach($advantages as $advantage)
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div>
                        <br>
                        <br>
                        <div class="advantage">
                            <div class="js-cy-brackets bg-opas-dark_" data-color="white" data-width="2" data-size="9">
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

<div class="container-fluid bottom-ark bg-pink px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>

