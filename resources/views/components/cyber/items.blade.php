<div class="container-fluid top-ark bg-purple px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>
<div class="container-fluid bg-purple px-0">
    <br>
    <div class="container cy-items-container">
        <div class="row">
            <?php $courses = [
                ['name' => 'Front', 'label' => 'JS'],
                ['name' => 'Back', 'label' => 'PHP'],
                ['name' => 'Gamedev', 'label' => 'C#'],
                ['name' => 'Foreign Lang', 'label' => 'En'],
            ]?>
            @foreach($courses as $course)
                <div class="col-12 col-sm-6 col-lg-3 mb-20">
                    <div class="pipki">
                        <div class="pipka"></div>
                        <div class="pipka"></div>
                        <div class="pipka"></div>
                    </div>
                    <div class="cy-item js-cy-brackets" data-color="orange" data-width="2" data-size="10">
                        <div class="cy-item-head">
                            <div class="cy-item-head-left">
                                <span> {{ $course['label'] }}</span>
                            </div>
                            <div class="cy-item-head-right">
                                <span>{{ $course['name'] }}</span>
                            </div>
                        </div>
                        <div class="cy-item-body">
                        </div>
                    </div>

                    <div class="item-btn-wrapper">
                        <div class="item-btn js-cyber-text-animation">
                            <span>Подробнее
{{--                                    <span class="fa-solid fa-floppy-disk"></span> --}}
                            </span>
                        </div>
                        <div class="item-btn-strokes">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <br>
    <br>
</div>
<div class="container-fluid bottom-ark bg-purple px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>
<br>
<br>
<br>
