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
        const promises = chars.map((char, index) => {
            return new Promise(resolve => {
                setTimeout(() => {
                    char.textContent = originalText[index];
                    resolve();
                }, index * 100);
            });
        });

        Promise.all(promises).then(() => {
            const event = new CustomEvent('myCustomEvent', {
                detail: {
                    message: 'Привет от первого скрипта!',
                    data: { id: 1, value: 'test' }
                }
            });
            document.dispatchEvent(event);
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

        }, 50);
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
                const actionText = "";
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

    // При наведении на .soon-module дата расшифровывается
    // Связка: hover на .soon-module → hover на .course-date ===
    const soonModules = document.querySelectorAll('.soon-module');
    soonModules.forEach(module => {
        const courseDateEl = module.querySelector('.course-date.js-cyber-text-animation');
        if (!courseDateEl) return;

        // Находим состояние этого course-date в массиве cyberButtons
        const dateState = cyberButtons.find(s => s.element === courseDateEl);
        if (!dateState) return;

        module.addEventListener('mouseenter', () => handleMouseEnter(dateState));
        module.addEventListener('mouseleave', () => handleMouseLeave(dateState));
    });
});

// Функция обработки дат
document.addEventListener('DOMContentLoaded', function () {

    const RANDOM_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    const ENCODE_SPEED = 250; // 4 раза в секунду
    const DECODE_SPEED = 80;

    const elements = document.querySelectorAll('.js-cyber-date-animation');

    elements.forEach(el => {

        const originalText = el.textContent.trim();
        const realText = el.getAttribute('x-date') || originalText;

        // если нет X — не трогаем
        if (!originalText.includes('X')) return;

        const state = {
            el,
            original: originalText,
            real: realText,
            chars: [],
            encodeInterval: null,
            decodeInterval: null,
            decoded: false,
            clickTimeout: null
        };

        // разбиваем на span
        el.innerHTML = '';

        for (let i = 0; i < originalText.length; i++) {
            const span = document.createElement('span');
            span.textContent = originalText[i];
            el.appendChild(span);
            state.chars.push(span);
        }

        // старт кодировки
        startEncoding(state);

        // hover
        el.addEventListener('mouseenter', () => {
            startDecoding(state);
        });

        el.addEventListener('mouseleave', () => {
            if (!state.decoded) {
                startEncoding(state);
            }
        });

        // click (фиксирует раскрытие на 6 сек)
        el.addEventListener('click', () => {
            startDecoding(state);

            clearTimeout(state.clickTimeout);
            state.clickTimeout = setTimeout(() => {
                state.decoded = false;
                startEncoding(state);
            }, 6000);
        });

    });

    function randomChar() {
        return RANDOM_CHARS[Math.floor(Math.random() * RANDOM_CHARS.length)];
    }

    // =========================
    // 🔐 КОДИРОВКА
    // =========================
    function startEncoding(state) {

        const ENCODE_SPEED = 300;

        clearInterval(state.encodeInterval);
        clearInterval(state.decodeInterval);

        // собираем индексы X один раз
        const xIndexes = [];

        for (let i = 0; i < state.original.length; i++) {
            if (state.original[i] === 'X') {
                xIndexes.push(i);
            }
        }

        state.encodeInterval = setInterval(() => {

            if (state.decoded) return;
            if (xIndexes.length === 0) return;

            // сколько символов менять (1 или 2)
            const changesCount = Math.random() > 0.5 ? 2 : 1;

            for (let i = 0; i < changesCount; i++) {

                const randomIndex = xIndexes[
                    Math.floor(Math.random() * xIndexes.length)
                    ];

                // меняем только один символ
                state.chars[randomIndex].textContent = randomChar();
            }

        }, ENCODE_SPEED);
    }

    // =========================
    // 🔓 РАСКОДИРОВКА
    // =========================
    function startDecoding(state) {

        clearInterval(state.encodeInterval);
        clearInterval(state.decodeInterval);

        state.decoded = true;

        // собираем индексы X
        const xIndexes = [];

        for (let i = 0; i < state.original.length; i++) {
            if (state.original[i] === 'X') {
                xIndexes.push(i);
            }
        }

        if (xIndexes.length === 0) return;

        let step = 0;

        state.decodeInterval = setInterval(() => {

            if (step >= xIndexes.length) {
                clearInterval(state.decodeInterval);

                // показать результат и вернуть кодировку
                setTimeout(() => {
                    state.decoded = false;
                    startEncoding(state);
                }, 2000);

                return;
            }

            const index = xIndexes[step];

            // 🔥 берём РЕАЛЬНЫЙ символ
            state.chars[index].textContent = state.real[index];

            step++;

        }, DECODE_SPEED);
    }

});

// Нужно написать отдельный скрипт на .js-cyber-date-animation
// Внутри  .js-cyber-date-animatio там либо дата в формате "01.01.2026" либо "XX.XX.2026"
// Если там открытая дата то просто показываем ее "01.01.2026" и ничего не делаем
// Если там зашифровано через  символ "X" то нужно к зашифрованным символам применять функцию "кодировки"
// которая 4 раза  в секунду меняет X на случайный символ или цифру. А при наведении на или клике на .js-cyber-date-animation
// происходит раскодировка сначало первый X показывается потом  второй, итд пока все не покажутся.
// Если пользователь убрал мышь то снова  функцию "кодировки" если был сделан клик то запускаем через 6 секунд
