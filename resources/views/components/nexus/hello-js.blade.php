<div class="container-fluid px-0">
    <section class="hero" id="hero">
        <div class="hero-grid-bg_" aria-hidden="true"></div>
        <div class="hero-content">
            <div class="hero-tag">
                <span class="accent">|</span> frontend
            </div>
            <h1 class="hero-title hero-title-js red" data-text="Java Script">
                <span class="highlight">Java Script</span>
            </h1>

            <div class="d-flex" style="gap: 10px;">
                <div class="flex-grow-1">
                    <p class="hero-subtitle-js bg-pink">
                        Самый популярный язык программирования в мире! Весь фронтенд строится на Java Script
                    </p>
                </div>
                {{--     внутри него нужно разместить 9 красных кубов, матрицей 3x3. и на js по очереди через 0.5 сек затемнять на 0.5 сек, на 90% каждый куб--}}
                {{--     скрипт прямо тут напиши--}}
                <div class="d-none d-lg-block bg-pink_" style="width: 48px; min-width: 48px;  display: flex; align-items: center; justify-content: center;">
                    <div class="d-grid" style="grid-template-columns: repeat(3, 1fr); gap: 2px;">
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                        <div class="js-square-block" style="width: 14px; height: 14px; background-color: #bb2c46;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cubes = document.querySelectorAll('.js-square-block');
        
        function animateCubes() {
            cubes.forEach((cube, index) => {
                setTimeout(() => {
                    cube.style.transition = 'opacity 0.5s';
                    cube.style.opacity = '0.1';
                    setTimeout(() => {
                        cube.style.opacity = '1';
                    }, 500);
                }, index * 500);
            });
        }
        
        // Запускаем первый цикл
        animateCubes();
        
        // Повторяем анимацию бесконечно (9 кубов * 500ms = 4500ms на полный цикл)
        setInterval(animateCubes, 4500);
    });
</script>
@endpush
