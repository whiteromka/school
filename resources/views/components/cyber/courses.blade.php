<div class="container">
    <h2 class="h2-common">
        {{--        <span>0.01</span> <br>--}}
        НАШИ КУРСЫ И МОДУЛИ
    </h2>
</div>

<div class="container-fluid top-ark bg-purple px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>
<div class="container-fluid  bg-purple px-0">
    <br>
</div>

<div class="container-fluid px-0 bg-purple_  wrapper-starfield ">
    <canvas id="starfield"></canvas>
    <div class="container-fluid px-0 signal-light">
        <div class="container cy-items-container" >
            <div class="row">
                @php $courses = [
                    [
                        'name' => 'Front', 'label' => 'JS', 'css' => 'bg-JS', 'crew' => 14, 'img' => 'img/site/fly_red.jpeg',
                        'tabs' => [
                            'speed'=>'1 PHP прост в освоении и позволяет быстро запускать проекты. Отличный выбор для старта в веб-разработке и быстрого прототипирования.',
                            'ecosystem' => '1 Огромная экосистема: Laravel, Symfony, Yii. Тысячи пакетов и готовых решений для реальных проектов.',
                            'practice' => '1 PHP используется в реальных продуктах и даёт быстрый выход на рынок труда. Минимум теории — максимум практики.'
                        ],
                        'link' => route('site.front')
                    ],
                    [
                        'name' => 'Back', 'label' => 'PHP', 'css' => 'bg-PHP', 'crew' => 17, 'img' => 'img/site/robo1.jpeg',
                        'tabs' => [
                            'speed'=>'2 PHP прост в освоении и позволяет быстро запускать проекты. Отличный выбор для старта в веб-разработке и быстрого прототипирования.',
                            'ecosystem' => '2 Огромная экосистема: Laravel, Symfony, Yii. Тысячи пакетов и готовых решений для реальных проектов.',
                            'practice' => '2 PHP используется в реальных продуктах и даёт быстрый выход на рынок труда. Минимум теории — максимум практики.'
                        ],
                        'link' => route('site.back')
                    ],
                    ['name' => 'Gamedev', 'label' => 'C#', 'css' => 'bg-DEFAULT', 'crew' => 2, 'img' => 'img/site/yellow.jpeg', 'tabs' => [], 'link' => route('site.gamedev')],
                    ['name' => 'Foreign Lang', 'label' => 'En', 'css' => 'bg-DEFAULT', 'crew' => 25, 'img' => 'img/site/neon_robo.jpeg', 'tabs' => [], 'link' => route('site.english')],
                ];
                @endphp

                @foreach($courses as $k => $course)
                    <div class="col-12 col-sm-6 col-xxl-3 mb-20 px-1">
                        <div class="pipki">
                            @for($i = 1; $i <= $course['crew']; $i++)
                                <div class="pipka"></div>
                            @endfor
                        </div>
                        <div class="cy-item js-cy-brackets" data-color="orange" data-width="2" data-size="10">
                            <div class="cy-item-head">
                                <div class="cy-item-head-left {{ $course['css'] }}">
                                    <span>{{ $course['label'] }}</span>
                                </div>
                                <div class="cy-item-head-right">
                                    <span>{{ $course['name'] }}</span>
                                </div>
                            </div>
                            <div class="cy-item-body">
                                @if($course['img'])
                                    <img src="{{ asset($course['img']) }}" class="img-fluid" alt="">
                                @endif
                                <div class="php-tabs-wrapper">
                                    {{-- Табы --}}
                                    @if(count($course['tabs']))
                                    <ul class="nav nav-tabs cy-item-tabs" id="{{$course['name']}}" role="tablist">
                                        @php
                                            $i = 1;
                                            foreach ($course['tabs'] as $tabKey => $tab):
                                        @endphp
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $i === 1 ? 'active' : ''}}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#{{ $course['name'] }}-{{ $tabKey }}"
                                                    type="button">
                                                {{ $tabKey }}
                                            </button>
                                        </li>
                                        @php
                                            $i++;
                                            endforeach;
                                        @endphp
                                    </ul>

                                    {{-- Таб контент --}}
                                    <div class="tab-content cy-item-tabs-content">
                                        @php $first = true; @endphp
                                        @foreach($course['tabs'] as $tabKey => $text)
                                            <div class="tab-pane fade {{ $first ? 'show active' : '' }}" id="{{ $course['name'] }}-{{ $tabKey }}">
                                                <p>{{ $text }}</p>
                                            </div>
                                            @php $first = false; @endphp
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <br>
                                <div class="cy-item-body-main-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aliquid nobis quas quos!
                                        Maxime nemo!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a class="item-btn-wrapper" href="{{ url($course['link']) }}">
                            <div class="item-btn js-cyber-text-animation">
                                <span>Подробнее</span>
                            </div>
                            <div class="item-btn-strokes">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container-fluid  bg-purple px-0">
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

@push('scripts')
<script>
    // Для создания звездного неба
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('starfield');
        const ctx = canvas.getContext('2d');
        const container = canvas.parentElement;

        function resize() {
            canvas.width = container.clientWidth;
            canvas.height = container.clientHeight;
        }

        resize();
        window.addEventListener('resize', resize);

        // Настройки
        const config = {
            stars1px: 120,   // количество маленьких звезд
            stars2px: 60,    // количество больших звезд
            speed1px: 0.04,   // скорость маленьких
            speed2px: 0.2    // скорость больших
        };
        const stars = [];

        class Star {
            constructor(size, baseSpeed) {
                this.size = size;
                this.baseSpeed = baseSpeed;
                this.reset(false);
            }

            reset(fromBottom = false) {
                this.x = Math.random() * canvas.width;

                this.y = fromBottom
                    ? canvas.height + Math.random() * canvas.height * 0.3
                    : Math.random() * canvas.height;

                // индивидуальная скорость
                this.speed = this.baseSpeed * (0.5 + Math.random());
                // микродвижение вбок
                this.drift = (Math.random() - 0.5) * 0.05;
            }

            update() {
                this.y -= this.speed;
                this.x += this.drift;

                // если улетела вверх или за край по X
                if (
                    this.y < -this.size ||
                    this.x < -10 ||
                    this.x > canvas.width + 10
                ) {
                    this.reset(true);
                }
            }

            draw() {
                ctx.fillStyle = '#fff';
                ctx.fillRect(this.x, this.y, this.size, this.size);
            }
        }

        // Создание звезд
        for (let i = 0; i < config.stars1px; i++) {
            stars.push(new Star(1, config.speed1px));
        }

        for (let i = 0; i < config.stars2px; i++) {
            stars.push(new Star(2, config.speed2px));
        }

        // Анимация
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (const star of stars) {
                star.update();
                star.draw();
            }
            requestAnimationFrame(animate);
        }
        animate();
    });
</script>

<script>
    // Для управления анимациями при наведении на модуль
    document.addEventListener('DOMContentLoaded', () => {
        const cyItems = document.querySelectorAll('.cy-item');

        cyItems.forEach(item => {
            let headTimeout,
                bracketTimeout,
                blinkInterval,
                spanTimeout,
                strokesStartTimeout,
                strokesTimeouts = [];

            item.addEventListener('mouseenter', () => {
                const headRight = item.querySelector('.cy-item-head-right');
                const headSpan = headRight.querySelector('span');

                // Мигалка для верхнего блока
                headTimeout = setTimeout(() => {
                    let count = 0;
                    blinkInterval = setInterval(() => {
                        headRight.classList.toggle('bs-blue');
                        count++;
                        if (count >= 6) {
                            clearInterval(blinkInterval);
                            headRight.classList.add('bs-blue');
                            spanTimeout = setTimeout(() => {
                                if (headSpan) {
                                    headSpan.classList.add('cy-item-head-right-hovered');
                                }
                            }, 100);
                        }
                    }, 100);
                }, 400);

                // Превращение скобок
                const brackets = item.querySelectorAll(
                    '.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br'
                );
                brackets.forEach(b => b.style.backgroundColor = 'transparent');
                bracketTimeout = setTimeout(() => {
                    brackets.forEach(b => b.style.backgroundColor = 'orange');
                }, 100);

                // Эмитируем событие наведения на кнопку
                const btnWrapper = item.parentElement.querySelector('.item-btn-wrapper');
                const cyberText = btnWrapper?.querySelector('.js-cyber-text-animation');
                if (cyberText) {
                    cyberText.dispatchEvent(new MouseEvent('mouseenter', { bubbles: true }));
                }

                // Красим кнопку по кускам
                const btn = btnWrapper?.querySelector('.item-btn');
                const strokes = btnWrapper?.querySelector('.item-btn-strokes');
                let strokeDivs = strokes ? Array.from(strokes.children).reverse() : [];
                strokeDivs.push(btn);
                console.log(strokeDivs)

                strokesStartTimeout = setTimeout(() => {
                    strokeDivs.forEach((div, i) => {
                        const t = setTimeout(() => {
                            div.classList.add('active');
                        }, i * 150);
                        strokesTimeouts.push(t);
                    });
                }, 1200);
            });

            item.addEventListener('mouseleave', () => {
                const headRight = item.querySelector('.cy-item-head-right');
                const headSpan = headRight.querySelector('span');

                clearTimeout(headTimeout);
                clearTimeout(bracketTimeout);
                clearTimeout(spanTimeout);
                clearTimeout(strokesStartTimeout);
                clearInterval(blinkInterval);

                strokesTimeouts.forEach(t => clearTimeout(t));
                strokesTimeouts = [];

                // Сброс
                headRight.classList.remove('bs-blue');
                if (headSpan) {
                    headSpan.classList.remove('cy-item-head-right-hovered');
                }

                const brackets = item.querySelectorAll(
                    '.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br'
                );
                brackets.forEach(b => b.style.backgroundColor = 'transparent');

                const btnWrapper = item.parentElement.querySelector('.item-btn-wrapper');
                const cyberText = btnWrapper?.querySelector('.js-cyber-text-animation');

                if (cyberText) {
                    cyberText.dispatchEvent(new MouseEvent('mouseleave', { bubbles: true }));
                }

                const strokes = btnWrapper?.querySelector('.item-btn-strokes');
                const btn = btnWrapper?.querySelector('.item-btn');
                if (strokes) {
                    strokes.querySelectorAll('div').forEach(div => {
                        div.classList.remove('active');
                    });
                }
                if (btn) {
                    btn.classList.remove('active');
                }
            });
        });
    });
</script>
@endpush

