<style>
    #rings-bg {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -2; /* фон под контент */
    }
    #rings-bg::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.15);
        pointer-events: none;
    }
</style>

<!-- Контейнер для VANTA.RINGS -->
<div id="rings-bg"></div>

<div class="container_ px-0" style="
    height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
">
    <section class="hero" id="hero_">
        <div class="hero-grid-bg_"></div>
        <div class="hero-content bg-pink p-20">
            <div class="hero-tag black">
                <span class="accent">|</span> gamedev
            </div>


            <h1 class="hero-title-no-ani js-glitch_" data-timer="10000" data-text="AGAMEDEV"
                style="text-shadow: 2px 2px 0px blue;"
            >
                <img src="{{ asset('/img/site/unity.png') }}" alt="" width="100px" class="img-fluid">
                <span class="highlight_">GAMEDEV</span>
            </h1>

            <h3 class="hero-subtitle-game ta-c" style="">
               Unity C# Blender
            </h3>
        </div>
    </section>
</div>

@push('scripts')

    <!-- Скрипты -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.rings.min.js"></script>
    <script>
        // Запускаем VANTA после загрузки DOM
        document.addEventListener('DOMContentLoaded', function () {
            VANTA.RINGS({
                el: "#rings-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200,
                minWidth: 200,
                scale: 1,
                scaleMobile: 1,
                color: 0xff6347, // пример цвета колец (томат)
                backgroundColor: 0x0a0a0a // фон под кольцами
            });
        });
    </script>

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.6.0/p5.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.trunk.min.js"></script>--}}
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            VANTA.TRUNK({--}}
{{--                el: "#rings-bg",--}}
{{--                mouseControls: true,--}}
{{--                touchControls: true,--}}
{{--                gyroControls: false,--}}
{{--                minHeight: 200,--}}
{{--                minWidth: 200,--}}
{{--                scale: 1,--}}
{{--                scaleMobile: 1,--}}
{{--                chaos: 3, // сила "хаоса"--}}
{{--                color: 0x00ffff, // цвет ветвей--}}
{{--                backgroundColor: 0x111111 // фон--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}


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
