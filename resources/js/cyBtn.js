/* Что бы заработало нужно добавить классы .js-cyber-text-animation .cy-btn */
document.addEventListener('DOMContentLoaded', function() {
    // Символы для хаотичного обновления
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*<>?";

    // Массив для хранения состояния всех кнопок
    const cyberButtons = [];

    // Находим все элементы с классами js-cyber-text-animation и js-cyber-text-once
    const animatedElements = document.querySelectorAll('.js-cyber-text-animation, .js-cyber-text-once');

    // Инициализируем каждый элемент
    animatedElements.forEach((element, index) => {
        // Сохраняем оригинальный текст элемента
        const originalText = element.textContent.trim();

        // Определяем тип элемента (анимированный или однократный)
        const isAnimationType = element.classList.contains('js-cyber-text-animation');
        const isOnceType = element.classList.contains('js-cyber-text-once');

        // Получаем значение таймера из data-cy-timer для однократных элементов
        let revealDelay = 3000; // Значение по умолчанию: 3 секунды

        if (isOnceType && element.hasAttribute('data-cy-timer')) {
            const timerValue = parseInt(element.getAttribute('data-cy-timer'));
            // Проверяем, что значение корректное число
            if (!isNaN(timerValue) && timerValue >= 0) {
                revealDelay = timerValue;
            }
        }

        // Создаем объект состояния для элемента
        const buttonState = {
            element: element,
            originalText: originalText,
            isAnimationType: isAnimationType,
            isOnceType: isOnceType,
            revealDelay: revealDelay, // Сохраняем время задержки
            isHovering: false,
            animationInterval: null,
            hoverAnimationInterval: null,
            chars: [],
            isRevealed: false
        };

        cyberButtons.push(buttonState);

        // Инициализируем текст элемента
        initializeButtonText(buttonState);

        // Запускаем анимацию символов для обоих типов
        startTextAnimation(buttonState);

        // Для анимированных кнопок добавляем обработчики событий
        if (isAnimationType) {
            element.addEventListener('mouseenter', () => handleMouseEnter(buttonState));
            element.addEventListener('mouseleave', () => handleMouseLeave(buttonState));
            element.addEventListener('click', () => handleClick(buttonState));
        }

        // Для однократных элементов запускаем раскодирование через указанное время
        if (isOnceType) {
            setTimeout(() => {
                stopAndRevealOnceTypeText(buttonState);
            }, buttonState.revealDelay);
        }
    });

    // Функция инициализации текста элемента
    function initializeButtonText(buttonState) {
        const element = buttonState.element;
        const originalText = buttonState.originalText;

        // Очищаем содержимое элемента
        element.innerHTML = '';

        // Создаем символы для каждого символа оригинального текста
        for (let i = 0; i < originalText.length; i++) {
            const charSpan = document.createElement('span');

            // Начальный символ - случайный из набора
            charSpan.textContent = getRandomCharacter();
            charSpan.dataset.target = originalText[i];

            element.appendChild(charSpan);
            buttonState.chars.push(charSpan);
        }
    }

    // Получение случайного символа
    function getRandomCharacter() {
        return characters[Math.floor(Math.random() * characters.length)];
    }

    // Анимация символов при обычном состоянии
    function startTextAnimation(buttonState) {
        if (buttonState.isRevealed) return;

        clearInterval(buttonState.animationInterval);

        buttonState.animationInterval = setInterval(() => {
            // Для анимированных кнопок проверяем hover
            if (buttonState.isAnimationType && buttonState.isHovering) return;

            // Для однократных проверяем, не раскрыты ли уже
            if (buttonState.isRevealed) return;

            const chars = buttonState.chars;
            if (chars.length === 0) return;

            // Случайно выбираем один символ для обновления
            const randomIndex = Math.floor(Math.random() * chars.length);
            chars[randomIndex].textContent = getRandomCharacter();
        }, 100);
    }

    // Остановка анимации и раскодирование для однократных элементов
    function stopAndRevealOnceTypeText(buttonState) {
        if (!buttonState.isOnceType || buttonState.isRevealed) return;

        // Останавливаем анимацию
        clearInterval(buttonState.animationInterval);
        buttonState.isRevealed = true;

        const chars = buttonState.chars;
        const originalText = buttonState.originalText;

        // Посимвольное раскодирование с задержкой
        chars.forEach((char, index) => {
            setTimeout(() => {
                char.textContent = originalText[index];
            }, index * 100); // Небольшая задержка между символами для эффекта
        });
    }

    // Обработка наведения на кнопку (только для анимированных)
    function handleMouseEnter(buttonState) {
        if (!buttonState.isAnimationType) return;

        buttonState.isHovering = true;
        clearInterval(buttonState.animationInterval);

        // Быстрая анимация превращения в оригинальный текст
        let currentIndex = 0;
        const chars = buttonState.chars;
        const originalText = buttonState.originalText;

        // Сначала быстро меняем все символы на случайные
        chars.forEach(char => {
            char.textContent = getRandomCharacter();
        });

        // Затем превращаем в оригинальный текст
        buttonState.hoverAnimationInterval = setInterval(() => {
            if (currentIndex >= chars.length) {
                clearInterval(buttonState.hoverAnimationInterval);
                return;
            }

            // Устанавливаем правильный символ для текущей позиции
            chars[currentIndex].textContent = originalText[currentIndex];
            currentIndex++;

        }, 30);
    }

    // Обработка ухода мыши с кнопки (только для анимированных)
    function handleMouseLeave(buttonState) {
        if (!buttonState.isAnimationType) return;

        buttonState.isHovering = false;
        clearInterval(buttonState.hoverAnimationInterval);

        // Быстро меняем все символы обратно на случайные
        const chars = buttonState.chars;
        let currentIndex = 0;

        const returnInterval = setInterval(() => {
            if (currentIndex >= chars.length) {
                clearInterval(returnInterval);
                // Перезапускаем обычную анимацию
                startTextAnimation(buttonState);
                return;
            }

            chars[currentIndex].textContent = getRandomCharacter();
            currentIndex++;

        }, 20);
    }

    // Обработка клика на кнопку (только для анимированных)
    function handleClick(buttonState) {
        if (!buttonState.isAnimationType) return;

        const chars = buttonState.chars;
        const button = buttonState.element;

        // Эффект мигания при клике
        button.style.animation = 'none';

        // Быстрая случайная смена символов
        let flashCount = 0;
        const flashInterval = setInterval(() => {
            chars.forEach(char => {
                char.textContent = getRandomCharacter();
            });

            flashCount++;

            if (flashCount > 6) {
                clearInterval(flashInterval);

                // Показываем сообщение о действии
                const actionText = "EXECUTING";
                chars.forEach((char, index) => {
                    setTimeout(() => {
                        if (index < actionText.length) {
                            char.textContent = actionText[index];
                        }
                    }, index * 40);
                });

                // Через некоторое время возвращаем исходное состояние
                setTimeout(() => {
                    if (!buttonState.isHovering) {
                        chars.forEach(char => {
                            char.textContent = getRandomCharacter();
                        });
                        startTextAnimation(buttonState);
                    }
                }, 1200);
            }
        }, 50);
    }
});
