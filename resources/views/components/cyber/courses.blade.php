<div class="container">
    <h2 class="h2-common">
{{--        <span class="fs-12">Courses</span><br>--}}
        НАШИ КУРСЫ
    </h2>
</div>

<div class="container-fluid top-ark bg-purple_  bg-pink_ bg-yellow_ bg-PHP_ bg-fantom px-0"
     style="border-top: 1px solid rgba(255,255,255,0.19)"
>
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>
<div class="container-fluid  bg-purple_ bg-pink_ bg-yellow_ bg-PHP_ bg-fantom px-0">
    <br>
</div>

<div class="container-fluid px-0 bg-purple_  wrapper-starfield">
    <canvas id="starfield"></canvas>
    <div class="container-fluid px-0 signal-light bg-yellow_ bg-fantom ">
        <div class="container cy-items-container">
            <div class="row">
                @php $courses = [
                    [
                        'name' => 'Front', 'label' => 'JS', 'css' => 'bg-JS', 'crew' => 14,
                        'tabs' => [
                            'promo'=>'JavaScript универсален и позволяет оживлять любые веб-интерфейсы. Незаменимый инструмент для фронтенда и идеальный фундамент для современной карьеры программиста.',
                            'practice' => '1 PHP используется в реальных продуктах и даёт быстрый выход на рынок труда. Минимум теории — максимум практики.'
                        ],
                        'link' => route('site.front')
                    ],
                    [
                        'name' => 'Back', 'label' => 'PHP', 'css' => 'bg-PHP', 'crew' => 17,
                        'tabs' => [
                            'promo'=>'PHP прост в освоении и позволяет быстро запускать проекты. Отличный выбор для старта в веб-разработке и быстрого прототипирования.',
                            'practice' => '2 PHP используется в реальных продуктах и даёт быстрый выход на рынок труда. Минимум теории — максимум практики.'
                        ],
                        'link' => route('site.back')
                    ],
                    [
                        'name' => 'Gamedev', 'label' => 'C#', 'css' => 'bg-DEFAULT', 'crew' => 2,
                        'tabs' => [
                            'promo' => 'C# надежен и является основным языком популярного движка Unity. Отличный выбор для создания игр и быстрого старта в индустрии геймдева.'
                        ], 'link' => route('site.gamedev')
                    ],
                    [
                        'name' => 'English', 'label' => 'En', 'css' => 'bg-DEFAULT', 'crew' => 25,
                        'tabs' => [
                            'promo' => 'Английский открывает доступ к оригинальной документации и глобальному комьюнити. Ключевой навык для работы в международных командах и быстрого карьерного роста.'
                        ], 'link' => route('site.english')
                    ],
                ];
                @endphp

                @foreach($courses as $k => $course)
                    <div class="col-12 col-sm-6 col-xxl-3 mb-20 px-1 js-item-container">
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
                                @include('components.frameshift.course', ['course' => $course])
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

<div class="container-fluid  bg-purple_ bg-yellow_ bg-PHP_ bg-fantom px-0">
    <br>
</div>
<div class="container-fluid bottom-ark bg-purple_ bg-yellow_ bg-PHP_ bg-fantom px-0">
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
    // Анимация случайных чисел и управление при наведении на .js-item-container
    document.addEventListener('DOMContentLoaded', () => {
        const itemContainers = document.querySelectorAll('.js-item-container');

        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        itemContainers.forEach(container => {
            const interfaceContainer = container.querySelector('.interface-container');
            const numberElement = interfaceContainer?.querySelector('.js-random-number');
            const topCodeElement = interfaceContainer?.querySelector('.js-top-code');
            const progressFill = interfaceContainer?.querySelector('.progress-fill');

            let headTimeout,
                bracketTimeout,
                blinkInterval,
                spanTimeout,
                strokesStartTimeout,
                strokesTimeouts = [],
                numberInterval,
                sideTextTimeout,
                sideTextIntervals = [];

            const cyItem = container.querySelector('.cy-item');
            const btnWrapper = container.querySelector('.item-btn-wrapper');
            const cyberText = btnWrapper?.querySelector('.js-cyber-text-animation');
            const btn = btnWrapper?.querySelector('.item-btn');
            const strokes = btnWrapper?.querySelector('.item-btn-strokes');
            const sideTexts = interfaceContainer?.querySelectorAll('.side-text');

            function updateNumbers() {
                if (!numberElement || !topCodeElement) return;
                let newNum = '';
                for(let i=0; i<13; i++) {
                    newNum += randomInt(0, 9);
                }
                numberElement.innerText = newNum;

                if(Math.random() > 0.7) {
                    let codePart = randomInt(100000, 999999);
                    let letter = String.fromCharCode(65 + randomInt(0, 25));
                    topCodeElement.innerText = `${codePart} ${letter}${letter}`;
                }
            }

            container.addEventListener('mouseenter', () => {
                // Запуск анимации чисел
                numberInterval = setInterval(updateNumbers, 150);

                const headRight = cyItem.querySelector('.cy-item-head-right');
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
                const brackets = cyItem.querySelectorAll(
                    '.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br'
                );
                brackets.forEach(b => b.style.backgroundColor = 'transparent');
                bracketTimeout = setTimeout(() => {
                    brackets.forEach(b => b.style.backgroundColor = 'orange');
                }, 100);

                // Красим кнопку по кускам
                let strokeDivs = strokes ? Array.from(strokes.children).reverse() : [];
                strokeDivs.push(btn);

                strokesStartTimeout = setTimeout(() => {
                    strokeDivs.forEach((div, i) => {
                        const t = setTimeout(() => {
                            div.classList.add('active');
                        }, i * 150);
                        strokesTimeouts.push(t);
                    });
                }, 1200);

                // Активируем прогресс-бар
                if (progressFill) {
                    progressFill.classList.add('progress-fill-active');
                }

                // Покраска side-text через 0.3 сек
                sideTextTimeout = setTimeout(() => {
                    if (sideTexts) {
                        sideTexts.forEach(sideText => {
                            // Оборачиваем каждый символ в span, если ещё не обернут
                            if (!sideText.querySelector('span.char')) {
                                const text = sideText.textContent;
                                sideText.textContent = '';
                                for (let char of text) {
                                    const span = document.createElement('span');
                                    span.className = 'char';
                                    span.textContent = char;
                                    span.style.color = '#885500';
                                    span.style.transition = 'color 0.1s';
                                    sideText.appendChild(span);
                                }
                            }

                            // Поочерёдно красим символы в красный
                            const chars = sideText.querySelectorAll('span.char');
                            const totalChars = chars.length;
                            chars.forEach((char, index) => {
                                const timeout = setTimeout(() => {
                                    char.style.color = 'red';
                                    // Когда последний символ покрашен, добавляем класс
                                    if (index === totalChars - 1) {
                                        const mainTitle = interfaceContainer?.querySelector('.main-title');
                                        if (mainTitle) {
                                            mainTitle.classList.add('main-title-active');
                                        }
                                    }
                                }, index * 50);
                                sideTextIntervals.push(timeout);
                            });
                        });
                    }
                }, 300);
            });

            container.addEventListener('mouseleave', () => {
                // Остановка анимации чисел
                clearInterval(numberInterval);

                const headRight = cyItem.querySelector('.cy-item-head-right');
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

                const brackets = cyItem.querySelectorAll(
                    '.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br'
                );
                brackets.forEach(b => b.style.backgroundColor = 'transparent');

                // Сброс кнопки
                if (strokes) {
                    strokes.querySelectorAll('div').forEach(div => {
                        div.classList.remove('active');
                    });
                }
                if (btn) {
                    btn.classList.remove('active');
                }

                // Деактивируем прогресс-бар
                if (progressFill) {
                    progressFill.classList.remove('progress-fill-active');
                }

                // Сброс side-text
                clearTimeout(sideTextTimeout);
                sideTextIntervals.forEach(interval => clearInterval(interval));
                sideTextIntervals = [];

                if (sideTexts) {
                    sideTexts.forEach(sideText => {
                        const chars = sideText.querySelectorAll('span.char');
                        chars.forEach(char => {
                            char.style.color = '#885500';
                        });
                    });
                }

                // Сброс класса у main-title
                const mainTitle = interfaceContainer?.querySelector('.main-title');
                if (mainTitle) {
                    mainTitle.classList.remove('main-title-active');
                }
            });
        });
    });
</script>

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
@endpush

