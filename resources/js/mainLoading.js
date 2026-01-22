document.addEventListener('DOMContentLoaded', function() {
    const loadingElements = document.querySelectorAll('.js-main-loading-percent');
    const bar = document.querySelector('.js-main-loading-style');

    loadingElements.forEach(element => {
        element.textContent = 0;
        let currentValue = 1;
        const endValue = 100;
        const duration = 2000;
        const increment = (endValue - currentValue) / (duration / 16.67);

        const interval = setInterval(() => {
            currentValue += increment;
            bar.style.width = currentValue + '%';
            if (currentValue >= endValue) {
                currentValue = endValue;
                clearInterval(interval);
            }
            element.textContent = Math.floor(currentValue);
        }, 20);
    });


});
