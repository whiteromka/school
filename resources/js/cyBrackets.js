document.addEventListener('DOMContentLoaded', function() {
    const bracketElements = document.querySelectorAll('.js-cy-brackets');

    // Скрываем zoom-controls при загрузке страницы
    const zoomControls = document.querySelectorAll('.zoom-controls > button');
    zoomControls.forEach(controls => {
        controls.style.display = 'none';
    });

    bracketElements.forEach(element => {
        const cornerColor = element.getAttribute('data-color') || 'red';
        const type = element.getAttribute('data-type') || 'box'; // box || square
        const width = element.getAttribute('data-width') || 1;
        const size = element.getAttribute('data-size') || 6;
        const onHover = element.getAttribute('data-on-hover') || null;
        const onClick = element.getAttribute('data-on-click') || null;

        const corners = [
            { class: 'cy-brackets-tl'},
            { class: 'cy-brackets-tr'},
            { class: 'cy-brackets-bl'},
            { class: 'cy-brackets-br'}
        ];

        // Создаем уголки
        corners.forEach(corner => {
            const cornerElement = document.createElement('div');
            cornerElement.className = corner.class;
            cornerElement.style.borderColor = cornerColor;
            if (width !== 1) {
                cornerElement.style.borderWidth = width + 'px';
            }
            if (size !== 1) {
                cornerElement.style.width = size + 'px';
                cornerElement.style.height = size + 'px';
            }
            element.appendChild(cornerElement);
        });

        // Функция для анимации уголков
        function animateCorners() {
            const cornerElements = element.querySelectorAll('.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br');

            cornerElements.forEach(corner => {
                corner.style.transition = 'opacity 0.1s ease';
                corner.style.opacity = '0';
            });

            setTimeout(() => {
                cornerElements.forEach(corner => {
                    corner.style.borderColor = 'green';
                    corner.style.opacity = '1';
                });
            }, 250);
        }

        let intervalBtnShowHidden = 100;
        // Функция для последовательного показа кнопок zoom-controls
        function showZoomControls() {
            const controls = element.querySelectorAll('.zoom-controls');

            controls.forEach(control => {
                const buttons = control.children;

                // Сбрасываем display перед анимацией
                for (let i = 0; i < buttons.length; i++) {
                    buttons[i].style.display = 'none';
                }

                // Показываем кнопки по очереди
                for (let i = 0; i < buttons.length; i++) {
                    setTimeout(() => {
                        buttons[i].style.display = 'block';
                    }, i * intervalBtnShowHidden);
                }
            });
        }

        // Функция для последовательного скрытия кнопок zoom-controls
        function hideZoomControls() {
            const controls = element.querySelectorAll('.zoom-controls');

            controls.forEach(control => {
                const buttons = control.children;

                // Скрываем кнопки по очереди
                for (let i = 0; i < buttons.length; i++) {
                    setTimeout(() => {
                        buttons[i].style.display = 'none';
                    }, i * intervalBtnShowHidden);
                }
            });
        }

        // Функция для сброса цвета уголков
        function resetCornersColor() {
            const cornerElements = element.querySelectorAll('.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br');
            cornerElements.forEach(corner => {
                corner.style.borderColor = cornerColor;
            });
        }

        // Объединенная функция для hover
        function handleHoverEnter() {
            animateCorners();
            setTimeout(()=> {
                showZoomControls();
            }, 500)
        }

        function handleHoverLeave() {
            resetCornersColor();
            hideZoomControls();
        }

        // Объединенная функция для click
        function handleClick() {
            animateCorners();
            setTimeout(()=> {
                showZoomControls();
            }, 500)

            if (typeof window[onClick] === 'function') {
                window[onClick]();
            }
        }

        // Логика для hover
        if (onHover !== null) {
            element.addEventListener('mouseenter', handleHoverEnter);
            element.addEventListener('mouseleave', handleHoverLeave);
        }

        // Логика для click
        if (onClick !== null) {
            element.addEventListener('click', handleClick);

            // Дополнительно скрываем при клике вне элемента
            document.addEventListener('click', function(e) {
                if (!element.contains(e.target)) {
                    hideZoomControls();
                    resetCornersColor();
                }
            });
        }
    });
});
