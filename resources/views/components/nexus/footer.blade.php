{{--===============  FOOTER ==============--}}
@php
    use Illuminate\Support\Facades\Route;
    $action = explode('@',Route::currentRouteAction())[1] ?? '';
@endphp
<footer class="footer {{ $action === 'gamedev' ? 'footer-game-dev' : '' }}">
    <div class="container-fluid">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="footer-left">
                        <div class="contact-info-block mx-auto">
                            <h4>Студентам</h4>
                            <div class="contact-method">
                                <div class="contact-method-label">Telegram</div>
                                <div class="contact-method-value">
                                    <span>{{ config('services.contacts.rom.telegram') }}</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <div class="contact-method-label">Email</div>
                                <div class="contact-method-value">
                                    <span> {{ config('services.contacts.rom.email') }} </span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <div class="contact-method-label">Services</div>
                                <div class="contact-method-value">
                                    <span>
                                        <a href="https://www.codewars.com/" target="_blank">codewars</a>
                                        <br>
                                        <a href="https://sql-academy.org" target="_blank">sql-academy</a>
                                        <br>
                                        <a href="https://getmentor.dev/" target="_blank">getmentor</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="footer-links_ footer-left">
                        <div class="contact-info-block mx-auto">
                            <h4>Бизнесу</h4>
                            <div class="contact-method">
                                <div class="contact-method-label">Telegram</div>
                                <div class="contact-method-value">
                                    <span>{{ config('services.contacts.rom.telegram') }}</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <div class="contact-method-label">Email</div>
                                <div class="contact-method-value">
                                    <span> {{ config('services.contacts.rom.email') }} </span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <div class="contact-method-label">Services</div>
                                <div class="contact-method-value">
                                    <span class="contact-method-value-ru">
                                        <a href="{{ route('businessRequest.create') }}">Разработка сайта</a>
                                        <br>
                                        <a href="{{ route('businessRequest.create') }}">Автоматизация бизнес процессов</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const footer = document.querySelector('.footer');
            const maxCubes = 10;
            const cubes = [];
            let poppedCount = 0;

            function random(min, max) {
                return Math.random() * (max - min) + min;
            }

            function createCube(delay) {
                const size = random(30, 70);
                const cube = document.createElement('div');
                cube.style.position = 'absolute';
                cube.style.width = `${size}px`;
                cube.style.height = `${size}px`;
                cube.style.backgroundColor = `rgba(255, 255, 255, ${random(0.03, 0.05)})`; // Сделал чуть заметнее
                cube.style.border = '1px solid rgba(255,255,255,0)';
                cube.style.pointerEvents = 'auto';
                cube.style.zIndex = '100';
                cube.style.transition = 'border-color 0.2s';
                cube.style.display = 'none'; // Скрываем изначально
                footer.appendChild(cube);

                // Наведение
                cube.addEventListener('mouseenter', () => cube.style.borderColor = 'rgba(255,0,0,0.8)');
                cube.addEventListener('mouseleave', () => cube.style.borderColor = 'rgba(255,255,255,0)');

                // Лопание с "взрывом"
                cube.addEventListener('click', (e) => {
                    poppedCount++;

                    // Получаем текущие координаты куба
                    const rect = cube.getBoundingClientRect();
                    const footerRect = footer.getBoundingClientRect();

                    // Позиция относительно footer
                    const currentX = rect.left - footerRect.left;
                    const currentY = rect.top - footerRect.top;

                    // Создаём частицы ДО скрытия куба
                    const pieces = [];
                    const pieceCount = Math.floor(random(5, 9));

                    for (let i = 0; i < pieceCount; i++) {
                        const p = document.createElement('div');
                        const ps = random(size * 0.15, size * 0.4);
                        p.style.width = `${ps}px`;
                        p.style.height = `${ps}px`;
                        p.style.backgroundColor = 'rgba(255, 100, 100, 0.8)';
                        p.style.position = 'absolute';
                        // Разбрасываем частицы из центра куба
                        p.style.left = (currentX + size/2 - ps/2) + 'px';
                        p.style.top = (currentY + size/2 - ps/2) + 'px';
                        p.style.pointerEvents = 'none';
                        p.style.zIndex = '1000';
                        footer.appendChild(p);

                        // Случайное направление разлёта
                        const angle = random(0, Math.PI * 2);
                        const velocity = random(2, 6);

                        pieces.push({
                            el: p,
                            vx: Math.cos(angle) * velocity,
                            vy: Math.sin(angle) * velocity - 2, // Немного вверх
                            alpha: 1,
                            gravity: 0.15
                        });
                    }

                    // Скрываем куб ПОСЛЕ создания частиц
                    cube.style.display = 'none';

                    // Анимация частиц
                    const animPieces = () => {
                        let alive = false;
                        for (let piece of pieces) {
                            // Физика
                            piece.vy += piece.gravity;
                            const currentLeft = parseFloat(piece.el.style.left);
                            const currentTop = parseFloat(piece.el.style.top);

                            piece.el.style.left = `${currentLeft + piece.vx}px`;
                            piece.el.style.top = `${currentTop + piece.vy}px`;
                            piece.alpha -= 0.025;
                            piece.el.style.opacity = piece.alpha;

                            if (piece.alpha > 0) alive = true;
                        }

                        if (alive) {
                            requestAnimationFrame(animPieces);
                        } else {
                            // Удаляем все частицы
                            for (let piece of pieces) {
                                if (piece.el.parentNode) {
                                    footer.removeChild(piece.el);
                                }
                            }
                        }
                    };

                    // Запускаем анимацию
                    requestAnimationFrame(animPieces);

                    // Возврат куба сверху через таймер
                    setTimeout(() => {
                        cubeData.y = -cubeData.size;
                        cubeData.x = random(0, footer.offsetWidth - cubeData.size);
                        cube.style.display = 'block';
                    }, 1000); // Увеличил задержку для завершения анимации
                });

                const cubeData = {
                    el: cube,
                    x: random(0, footer.offsetWidth - size),
                    y: -size,
                    size: size,
                    speed: random(0.5, 1.5), // Немного быстрее
                    step: random(10, 30) // Размер ступеньки для дерганой анимации
                };

                // Показываем куб с задержкой
                setTimeout(() => {
                    cube.style.display = 'block';
                }, delay);

                return cubeData;
            }

            // Создаём кубы с разными задержками (0-3000 мс)
            for (let i = 0; i < maxCubes; i++) {
                const delay = random(0, 3000);
                const cube = createCube(delay);
                cube.el.style.top = `${cube.y}px`;
                cube.el.style.left = `${cube.x}px`;
                cubes.push(cube);
            }

            function animate() {
                const footerHeight = footer.offsetHeight;
                const footerWidth = footer.offsetWidth;

                for (let cube of cubes) {
                    if (cube.el.style.display !== 'none') {
                        cube.y += cube.speed;

                        if (cube.y > footerHeight) {
                            cube.y = -cube.size;
                            cube.x = random(0, footerWidth - cube.size);
                        }

                        // Ступенчатая анимация — округляем до ближайшей ступеньки
                        const steppedY = Math.floor(cube.y / cube.step) * cube.step;
                        cube.el.style.top = `${steppedY}px`;
                        cube.el.style.left = `${cube.x}px`;
                    }
                }

                requestAnimationFrame(animate);
            }

            function checkAndAnimate() {
                if (window.innerWidth >= 768) {
                    animate();
                }
            }
             checkAndAnimate();
        });
    </script>
@endpush
