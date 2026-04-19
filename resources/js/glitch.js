document.addEventListener('DOMContentLoaded', () => {
    const glitchElements = document.querySelectorAll('.js-glitch');
    if (glitchElements.length === 0) return;

    function activateGlitch(element) {
        element.classList.add('glitch');
        setTimeout(() => {
            element.classList.remove('glitch');
        }, 300);
    }

    // Элементы с data-timer — работают независимо
    const timedElements = document.querySelectorAll('.js-glitch[data-timer]');
    timedElements.forEach(element => {
        setTimeout(() => activateGlitch(element), 1000);
        const interval = parseInt(element.dataset.timer, 10) || 10000;
        setInterval(() => activateGlitch(element), interval);
    });

    // Остальные элементы — циклический перебор
    const cycleElements = [...glitchElements].filter(el => !el.dataset.timer);
    if (cycleElements.length === 0) return;

    let currentIndex = 0;

    function runCycle() {
        const currentElement = cycleElements[currentIndex];
        activateGlitch(currentElement);
        currentIndex = (currentIndex + 1) % cycleElements.length;
        setTimeout(runCycle, 3000);
    }

    runCycle();
});
