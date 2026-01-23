document.addEventListener('DOMContentLoaded', function() {
    const loadingElements = document.querySelectorAll('.js-main-loading-percent');
    const bar = document.querySelector('.js-main-loading-style');

    setTimeout(function() {
        loadingElements.forEach(element => {
            element.textContent = 0;
            let currentValue = 1;
            const endValue = 100;
            const duration = 3000;
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
    }, 4000)
});

// Тест события myCustomEvent. Оно создано в
// document.addEventListener('myCustomEvent', function(event) {
//     console.log('Событие получено:', event.detail.message);
//     console.log('Данные:', event.detail.data);
// });
