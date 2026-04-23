// Скрипт для показа сообщений при наведении на элемент
const style = document.createElement('style');
document.head.appendChild(style);

const tooltip = document.createElement('div');
tooltip.className = 'custom-tooltip';
document.body.appendChild(tooltip);

// Функция для показа тултипа
function showTooltip(element) {
    const context = element.getAttribute('data-context');
    if (!context) return;

    const color = element.getAttribute('data-color');
    tooltip.className = 'custom-tooltip' + (color === 'red' ? ' error-tooltip' : '');
    tooltip.textContent = context;

    // Сначала делаем видимым, но скрытым (чтобы получить размеры)
    tooltip.style.visibility = 'hidden';
    tooltip.classList.add('visible');

    const rect = element.getBoundingClientRect();
    const tooltipRect = tooltip.getBoundingClientRect();

    const viewportWidth = window.innerWidth;
    const viewportHeight = window.innerHeight;

    // Свободное место
    const space = {
        top: rect.top,
        bottom: viewportHeight - rect.bottom,
        left: rect.left,
        right: viewportWidth - rect.right
    };

    let top, left;

    // Приоритет: где влезает полностью
    if (space.top >= tooltipRect.height + 8) {
        // сверху
        top = rect.top - tooltipRect.height - 8;
        left = rect.left + rect.width / 2 - tooltipRect.width / 2;
        tooltip.dataset.position = 'top';
    } else if (space.bottom >= tooltipRect.height + 8) {
        // снизу
        top = rect.bottom + 8;
        left = rect.left + rect.width / 2 - tooltipRect.width / 2;
        tooltip.dataset.position = 'bottom';
    } else if (space.right >= tooltipRect.width + 8) {
        // справа
        top = rect.top + rect.height / 2 - tooltipRect.height / 2;
        left = rect.right + 8;
        tooltip.dataset.position = 'right';
    } else if (space.left >= tooltipRect.width + 8) {
        // слева
        top = rect.top + rect.height / 2 - tooltipRect.height / 2;
        left = rect.left - tooltipRect.width - 8;
        tooltip.dataset.position = 'left';
    } else {
        // fallback — где больше места
        const maxSide = Object.entries(space).sort((a, b) => b[1] - a[1])[0][0];

        switch (maxSide) {
            case 'top':
                top = rect.top - tooltipRect.height - 8;
                left = rect.left + rect.width / 2 - tooltipRect.width / 2;
                break;
            case 'bottom':
                top = rect.bottom + 8;
                left = rect.left + rect.width / 2 - tooltipRect.width / 2;
                break;
            case 'right':
                top = rect.top + rect.height / 2 - tooltipRect.height / 2;
                left = rect.right + 8;
                break;
            case 'left':
                top = rect.top + rect.height / 2 - tooltipRect.height / 2;
                left = rect.left - tooltipRect.width - 8;
                break;
        }

        tooltip.dataset.position = maxSide;
    }

    // Корректировка, чтобы не вылезал за края
    left = Math.max(8, Math.min(left, viewportWidth - tooltipRect.width - 8));
    top = Math.max(8, Math.min(top, viewportHeight - tooltipRect.height - 8));

    tooltip.style.top = `${top + window.scrollY}px`;
    tooltip.style.left = `${left + window.scrollX}px`;

    tooltip.style.visibility = 'visible';

    // центр элемента (куда должна смотреть стрелка)
    const anchorX = rect.left + rect.width / 2;
    const anchorY = rect.top + rect.height / 2;

// позиция тултипа
    const tooltipLeft = left;
    const tooltipTop = top;

// вычисляем позицию стрелки
    const arrowSize = 6; // как в CSS border
    const padding = 8;   // отступ от края тултипа
    if (tooltip.dataset.position === 'top' || tooltip.dataset.position === 'bottom') {
        let arrowLeft = anchorX - tooltipLeft;

        // ограничиваем внутри тултипа
        arrowLeft = Math.max(padding, Math.min(arrowLeft, tooltipRect.width - padding));

        tooltip.style.setProperty('--arrow-left', `${arrowLeft}px`);
    } else {
        let arrowTop = anchorY - tooltipTop;

        arrowTop = Math.max(padding, Math.min(arrowTop, tooltipRect.height - padding));

        tooltip.style.setProperty('--arrow-top', `${arrowTop}px`);
    }

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
