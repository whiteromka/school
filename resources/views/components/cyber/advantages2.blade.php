<div class="container">
    <h2 class="h2-common">
{{--        <span>In conclusion</span>--}}
        Что получите по итогу
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
    @include('components.cyber.x-text')

    <div class="container">
        <div class="row">

            <?php $advantages = [
                ['n' => '01', 'name' => 'Знания и навыки', 'descr' => 'Понимание принципов на которых строится все программирование'],
                ['n' => '02','name' => 'Актуальный опыт', 'descr' => 'Опыт решения задач junior-middle уровня с учетом актуальных практик'],
                ['n' => '03','name' => 'Проекты в портфолио', 'descr' => 'После прохождения модуля у вас останется проект который можно добавить в свое портфолио'],
                ['n' => '04','name' => 'Сертификат', 'descr' => 'Именной электронный сертификат о прохождении модуля. <a href="#">Сертификат</a> '],
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
