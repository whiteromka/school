@php use App\Models\Vacancy; @endphp
<?php
/** @var Vacancy[] $vacancies */
/** @var string $userIp */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- Фон из сетки квадратов --}}
<div class="grid-background" id="gridBackground"></div>

{{--Основной контейнер для контента--}}
<div class="container-fluid mt-10vh px-0 main-container">
    @include('components.nexus.navigation')

    <div class="main">
        @yield('content')
    </div>

    @include('components.nexus.footer')
</div>

@livewireScripts
@stack('scripts')

<script>
    const style = document.createElement('style');
    document.head.appendChild(style);

    const tooltip = document.createElement('div');
    tooltip.className = 'custom-tooltip';
    document.body.appendChild(tooltip);

    // Функция для показа тултипа
    function showTooltip(element) {
        const context = element.getAttribute('data-context');
        if (!context) return;

        // Проверяем цвет для специального стиля
        const color = element.getAttribute('data-color');
        tooltip.className = 'custom-tooltip' + (color === 'red' ? ' error-tooltip' : '');
        tooltip.textContent = context;

        // Получаем позицию элемента
        const rect = element.getBoundingClientRect();
        const tooltipRect = tooltip.getBoundingClientRect();

        // Позиционируем над элементом
        const top = rect.top - tooltipRect.height - 8;
        const left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);

        tooltip.style.top = `${top + window.scrollY}px`;
        tooltip.style.left = `${left + window.scrollX}px`;
        tooltip.classList.add('visible');
    }

    // Функция для скрытия тултипа
    function hideTooltip() {
        tooltip.classList.remove('visible');
    }

    // Навешиваем обработчики на все элементы с data-context
    function initTooltips() {
        const elements = document.querySelectorAll('[data-context]');

        elements.forEach(el => {
            el.addEventListener('mouseenter', () => showTooltip(el));
            el.addEventListener('mouseleave', hideTooltip);
            el.addEventListener('focus', () => showTooltip(el));
            el.addEventListener('blur', hideTooltip);
        });
    }

    // Инициализация при загрузке
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTooltips);
    } else {
        initTooltips();
    }

    // Также инициализируем при изменении DOM (для динамически добавляемых элементов)
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.nodeType === 1) { // Element node
                    if (node.hasAttribute && node.hasAttribute('data-context')) {
                        node.addEventListener('mouseenter', () => showTooltip(node));
                        node.addEventListener('mouseleave', hideTooltip);
                        node.addEventListener('focus', () => showTooltip(node));
                        node.addEventListener('blur', hideTooltip);
                    }
                    // Проверяем дочерние элементы
                    if (node.querySelectorAll) {
                        const children = node.querySelectorAll('[data-context]');
                        children.forEach(child => {
                            child.addEventListener('mouseenter', () => showTooltip(child));
                            child.addEventListener('mouseleave', hideTooltip);
                            child.addEventListener('focus', () => showTooltip(child));
                            child.addEventListener('blur', hideTooltip);
                        });
                    }
                }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });

</script>

</body>
</html>
