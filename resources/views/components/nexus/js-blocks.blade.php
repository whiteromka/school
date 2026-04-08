@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var Collection $modules */
    /** @var int[] $userModuleIds */
    $max = 94;
@endphp

<div class="container">
    <section>
        <div class="section-header">
            <div class="section-label">Modules</div>
            <h2 class="section-title">Модули курса FRONTEND</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        <div class="row mb-10">
            <div class="col-12">
                @include('components.frameshift.info-panel')
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-2">
                @php
                    $i = 1;
                    /** @var App\Models\Module $module */
                    foreach($modules as $module):
                @endphp
                @include('components.nexus.module', ['max'=>94, 'i' => $i, 'module' => $module])
                @php
                    $i++;
                    endforeach
                @endphp
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ITEM_WIDTH = 3;      // ширина блока .item в px
            const GAP_WIDTH = 2;       // gap между блоками в px
            const TOTAL_PER_ITEM = ITEM_WIDTH + GAP_WIDTH; // 9px на один блок
            const MAX_USERS = 94;      // максимальное количество пользователей

            /**
             * Отрисовка блоков заполненности для одной карточки
             */
            function renderCountBlocks(card) {
                const countLine = card.querySelector('.service-card-count-line');
                if (!countLine) return;

                // Получаем данные из data-атрибутов
                const usersCount = parseInt(card.dataset.usersCount || 0, 10);
                const max = parseInt(card.dataset.maxUsers || MAX_USERS, 10);

                // Вычисляем процент заполненности
                const percent = Math.min(usersCount / max, 1);

                // Вычисляем сколько блоков влезает в линию
                const lineWidth = countLine.offsetWidth;
                const maxItems = Math.floor(lineWidth / TOTAL_PER_ITEM);

                // Вычисляем сколько блоков нужно показать (пропорционально проценту)
                let itemsToShow = Math.floor(maxItems * percent);

                // Если записан хотя бы 1 человек - всегда показываем хотя бы 1 блок
                if (usersCount >= 1 && itemsToShow < 1) {
                    itemsToShow = 1;
                }

                // Очищаем и создаём блоки
                countLine.innerHTML = '';

                for (let i = 0; i < itemsToShow; i++) {
                    const item = document.createElement('div');
                    item.className = 'item';
                    countLine.appendChild(item);
                }
            }

            /**
             * Перерисовка всех карточек
             */
            function renderAllCards() {
                document.querySelectorAll('.service-card').forEach(card => {
                    renderCountBlocks(card);
                });
            }

            // Первичная отрисовка
            renderAllCards();

            // Перерисовка при изменении размера окна
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(renderAllCards, 150);
            });

            // Hover-эффекты для карточек
            document.querySelectorAll('.service-card').forEach(card => {
                let hoverTimeout, spanTimeouts = [], colorTimeout;

                card.addEventListener('mouseenter', () => {
                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv?.querySelectorAll('span span') || [];

                    hoverTimeout = setTimeout(() => {
                        if (rightDiv) {
                            rightDiv.style.borderLeft = '1px dotted #00f0ff';
                            rightDiv.style.transition = 'all 0.3s ease';
                        }

                        spans.forEach((span, index) => {
                            spanTimeouts.push(setTimeout(() => {
                                span.className = span.className.replace('_', '');
                            }, 400 + (index * 100)));
                        });

                        colorTimeout = setTimeout(() => {
                            if (rightDiv) rightDiv.style.color = '#8b8b8b';
                        }, 900);
                    }, 400);
                });

                card.addEventListener('mouseleave', () => {
                    clearTimeout(hoverTimeout);
                    spanTimeouts.forEach(clearTimeout);
                    spanTimeouts = [];
                    clearTimeout(colorTimeout);

                    const rightDiv = card.querySelector('.right > div');
                    const spans = rightDiv?.querySelectorAll('span span') || [];

                    if (rightDiv) {
                        rightDiv.style.borderLeft = '';
                        rightDiv.style.paddingLeft = '';
                        rightDiv.style.color = '#343434';
                    }

                    spans.forEach(span => {
                        if (!span.className.includes('_')) {
                            span.className += '_';
                        }
                    });
                });
            });
        });
    </script>
@endpush
