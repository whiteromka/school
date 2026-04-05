<div class="container-fluid px-0">
    <section class="hero" id="hero">
        <div class="hero-grid-bg"></div>
        <div class="hero-content">
            <div class="hero-tag">
                <span class="accent">|</span> backend
            </div>
            <h1 class="hero-title" data-text="BACKEND WITH PHP">
                BACKEND WITH
                <span class="highlight">PHP </span>
            </h1>
            <p class="hero-subtitle">
                Простой и проверенный язык для быстрой разработки backend части приложений.
                Отличный выбор для первого языка программирования.
            </p>
        </div>
    </section>

    @php
        $imgs = ['/img/site/back/d6.jpg', '/img/site/back/d3.jpg', '/img/site/back/t5.jpg', '/img/site/back/t12.jpg', '/img/site/back/d10.jpg', '/img/site/back/d8.jpg'];
    @endphp
    <div class="container px-0">
        <div class="row">
            @foreach($imgs as $img)
                <div class="col-6 col-sm-6 col-md-4 col-lg-2 px-2 mb-15 js-glitch_">
                    <div class="img-wrapper">
                        <img src="{{ asset($img) }}" alt="" class="img-fluid">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@push('scripts')
    <script>
        // Анимируем изображения
        document.addEventListener("DOMContentLoaded", function() {
            const wrappers = document.querySelectorAll('.img-wrapper');

            wrappers.forEach(wrapper => {
                const tl = document.createElement('div');
                const tr = document.createElement('div');
                const bl = document.createElement('div');
                const br = document.createElement('div');
                tl.className = 'corner-bracket corner-tl';
                tr.className = 'corner-bracket corner-tr';
                bl.className = 'corner-bracket corner-bl';
                br.className = 'corner-bracket corner-br';
                wrapper.appendChild(tl);
                wrapper.appendChild(tr);
                wrapper.appendChild(bl);
                wrapper.appendChild(br);
                wrapper.addEventListener('mouseenter', () => {
                    wrapper.classList.add('active');
                });
                wrapper.addEventListener('mouseleave', () => {
                    wrapper.classList.remove('active');
                });
            });
        });

    </script>
@endpush
