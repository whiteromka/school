document.addEventListener('DOMContentLoaded', () => {
    // Находим все элементы с классом .js-glitch
    const glitchElements = document.querySelectorAll('.js-glitch');
    if (glitchElements.length === 0) return;
    let currentIndex = 0;

    // Функция активации глитча для одного элемента
    function activateGlitch(element) {
        element.classList.add('glitch');
        setTimeout(() => {
            element.classList.remove('glitch');
        }, 300);
    }

    // Основная функция цикла
    function runCycle() {
        const currentElement = glitchElements[currentIndex];
        activateGlitch(currentElement);
        currentIndex = (currentIndex + 1) % glitchElements.length;
        setTimeout(runCycle, 5000);
    }

    runCycle();
});
