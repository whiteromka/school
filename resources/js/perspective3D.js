document.addEventListener('DOMContentLoaded', function() {
    const scene = document.querySelector('.scene');
    const cubeContainer = document.querySelector('.cube-container');

    if (!scene || !cubeContainer) return;

    // Сохраняем начальное вращение
    const initialTransform = 'translate(-50%, -50%) rotateX(-10deg) rotateY(-30deg)';
    cubeContainer.style.transform = initialTransform;

    // Функция для обработки движения мыши
    function handleMouseMove(e) {
        // Получаем размеры и позицию сцены
        const rect = scene.getBoundingClientRect();

        // Вычисляем положение мыши относительно центра сцены
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        // Вычисляем смещение от центра (от -1 до 1)
        const mouseX = (e.clientX - centerX) / (rect.width / 2);
        const mouseY = (e.clientY - centerY) / (rect.height / 2);

        // Ограничиваем значения (от -1 до 1)
        const limitedX = Math.max(-1, Math.min(1, mouseX));
        const limitedY = Math.max(-1, Math.min(1, mouseY));

        // Вычисляем углы вращения (максимум 30 градусов в каждую сторону)
        const rotateY = limitedX * 30; // Горизонтальное движение -> вращение по Y
        const rotateX = -limitedY * 15; // Вертикальное движение -> вращение по X (инвертируем)

        // Применяем трансформацию
        cubeContainer.style.transform = `translate(-50%, -50%) rotateX(${-10 + rotateX}deg) rotateY(${-20 + rotateY}deg)`;
    }

    // Функция для сброса вращения
    function handleMouseLeave() {
        cubeContainer.style.transition = 'transform 0.5s ease';
        cubeContainer.style.transform = initialTransform;

        // Убираем transition после анимации
        setTimeout(() => {
            cubeContainer.style.transition = '';
        }, 500);
    }

    // Обработчики событий
    scene.addEventListener('mousemove', handleMouseMove);
    scene.addEventListener('mouseleave', handleMouseLeave);

    // Добавляем transition при входе в сцену
    scene.addEventListener('mouseenter', () => {
        cubeContainer.style.transition = 'transform 0.1s ease';
    });
});
