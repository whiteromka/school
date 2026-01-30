<div class="container-fluid top-ark bg-yellow px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>

<div class="container-fluid bg-yellow px-0">
    <div class="container">
        <div class="row">
            <br><br>
        </div>
        <div class="row">
            <?php $advantages = [
                ['name' => 'Групповые занятия', 'descr' => 'Теория + практика'],
                ['name' => 'Востребованные технологии' , 'descr' => '...'],
                ['name' => 'Востребованные технологии' , 'descr' => '...'],
//                ['name' => 'JS', 'descr' => 'Самый популярный язык программирования в мире'],
//                ['name' => 'PHP', 'descr' => '75% всего интернета в мире работает на PHP. Один из наиболее востребованных язык программирования в СНГ'],
//                ['name' => 'GameDev', 'descr' => 'lorem ...'],
//                ['name' => 'English', 'descr' => 'Язык который стоит изучать каждому IT специалисту'],
//                ['name' => 'Почти даром', 'descr' => 'lorem ...'],
//                ['name' => "Но за ₽", 'descr' => 'lorem ...'],
            ];?>
            @foreach($advantages as $advantage)
            <div class="col-md-2">
                <div class="pos-r">
                    <div class="advantage">
                        <span> {{ $advantage['name'] }} </span>
                    </div>
                    <p class="advantage-descr"> {{ $advantage['descr'] }} </p>
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

