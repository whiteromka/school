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
                ['name' => 'Вкусно', 'descr' => 'lorem ...'],
                ['name' => 'Незабываемо', 'descr' => 'lorem ...'],
                ['name' => 'Интересно', 'descr' => 'lorem ...'],
                ['name' => 'Полезно', 'descr' => 'lorem ...'],
                ['name' => 'Почти даром', 'descr' => 'lorem ...'],
                ['name' => 'Но за $', 'descr' => 'lorem ...'],
            ];?>
            @foreach($advantages as $advantage)
            <div class="col-md-2">
                <div class="pos-r">
                    <div class="advantage">
                        <span> {{ $advantage['name'] }} </span>
{{--                        <span> {{ $advantage['descr'] }} </span>--}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <br> <br>
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

