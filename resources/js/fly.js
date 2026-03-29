/**
 * Анимация медленно летающих зеленых треугольников (как самолеты на радаре)
 * Внутри элемента .grid-background
 * С трассировкой следа
 */

// === Настройки ===
const CONFIG = {
    maxPlanes: 2,              // Количество треугольников
    planeSize: 50,             // Размер для расчёта границ
    baseSpeed: 0.2,            // Базовая скорость
    directionChangeInterval: 2500, // Средний интервал смены направления (мс)
    directionChangeChance: 0.05,   // Шанс смены направления
    // 8 направлений: 0°, 45°, 90°, 135°, 180°, 225°, 270°, 315°
    directions: [0, 45, 90, 135, 180, 225, 270, 315]
};

// === Настройки следа ===
const TRAIL = {
    length: 80,           // Длина следа (количество точек)
    updateInterval: 4000,  // Как часто добавлять точку в след (мс)
    fadeTime: 80000        // Время исчезновения следа (мс)
};

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('gridBackground');
    if (!container) {
        console.warn('Контейнер #gridBackground не найден');
        return;
    }

    // Создаём SVG для следов
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('width', '100%');
    svg.setAttribute('height', '100%');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    svg.style.pointerEvents = 'none';
    svg.style.zIndex = '0';
    container.appendChild(svg);

    const planes = [];

    // Названия групп и статусы
    const groupNames = ['ALFA', 'BRAVO', 'WHISKEY', 'FOXTROT'];
    const statuses = ['online', 'offline'];

    // Создаём треугольники
    for (let i = 0; i < CONFIG.maxPlanes; i++) {
        const element = document.createElement('div');
        element.className = 'radar-plane';
        element.style.opacity = '0.4'; // Изначально 60% прозрачности
        container.appendChild(element);

        // Создаём метку с информацией
        const label = document.createElement('div');
        label.className = 'radar-plane-label';
        const groupName = groupNames[i % groupNames.length];
        const status = statuses[i % statuses.length];
        label.innerHTML = `
            <span class="group-name">${groupName}</span>
            <span class="status ${status}">${status.toUpperCase()}</span>
        `;
        container.appendChild(label);

        // Выбираем случайное направление из 8 возможных
        const randomDirIndex = Math.floor(Math.random() * CONFIG.directions.length);
        const angle = CONFIG.directions[randomDirIndex] * Math.PI / 180;
        const speed = CONFIG.baseSpeed * (0.8 + Math.random() * 0.4);

        // Создаём путь для следа
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill', 'none');
        path.setAttribute('stroke', 'rgba(085,085,085,0.81)');
        path.setAttribute('stroke-width', '1');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-dasharray', '10 10');
        path.setAttribute('opacity', '0.4');
        path.style.filter = 'drop-shadow(0 0 3px #00ff00)';
        svg.appendChild(path);

        const plane = {
            element: element,
            label: label,
            path: path,
            x: Math.random() * (window.innerWidth - CONFIG.planeSize),
            y: Math.random() * (window.innerHeight - CONFIG.planeSize),
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed,
            angle: angle,
            trail: [],
            lastDirectionChange: Date.now(),
            nextDirectionChange: CONFIG.directionChangeInterval * (0.8 + Math.random() * 0.4),
            lastTrailPoint: Date.now()
        };

        planes.push(plane);
    }

    // Анимация
    function animate() {
        const now = Date.now();

        planes.forEach(plane => {
            // Проверяем, не пора ли обновить след
            if (now - plane.lastTrailPoint > TRAIL.updateInterval) {
                // Исчезновение: сразу 100%, через 0.2 сек 40% (на 60% тусклее)
                plane.element.style.opacity = '1';
                setTimeout(() => {
                    plane.element.style.opacity = '0.4';
                }, 200);

                // Добавляем точку в след (по центру треугольника)
                const trailX = plane.x + 10;
                const trailY = plane.y + 11;
                plane.trail.push({ x: trailX, y: trailY, time: now });

                // Удаляем старые точки
                while (plane.trail.length > TRAIL.length || (plane.trail.length > 0 && now - plane.trail[0].time > TRAIL.fadeTime)) {
                    plane.trail.shift();
                }

                // Обновляем путь следа
                if (plane.trail.length > 1) {
                    let d = `M ${plane.trail[0].x} ${plane.trail[0].y}`;
                    for (let i = 1; i < plane.trail.length; i++) {
                        d += ` L ${plane.trail[i].x} ${plane.trail[i].y}`;
                    }
                    plane.path.setAttribute('d', d);
                }

                plane.lastTrailPoint = now;
            }

            // Проверяем, не пора ли сменить направление
            if (now - plane.lastDirectionChange > plane.nextDirectionChange) {
                if (Math.random() < CONFIG.directionChangeChance) {
                    // Поворот на ±45° или ±90°
                    const turnOptions = [-45, 45, -90, 90];
                    const randomTurn = turnOptions[Math.floor(Math.random() * turnOptions.length)];
                    const currentAngle = Math.atan2(plane.vy, plane.vx);
                    const newAngle = currentAngle + randomTurn * Math.PI / 180;
                    const speed = Math.sqrt(plane.vx * plane.vx + plane.vy * plane.vy);

                    plane.vx = Math.cos(newAngle) * speed;
                    plane.vy = Math.sin(newAngle) * speed;
                }

                plane.lastDirectionChange = now;
                plane.nextDirectionChange = CONFIG.directionChangeInterval * (0.8 + Math.random() * 0.4);
            }

            // Движение
            plane.x += plane.vx;
            plane.y += plane.vy;

            // Отскок от границ
            if (plane.x <= 0 || plane.x >= window.innerWidth - CONFIG.planeSize) {
                plane.vx = -plane.vx;
                plane.x = Math.max(0, Math.min(plane.x, window.innerWidth - CONFIG.planeSize));
            }
            if (plane.y <= 0 || plane.y >= window.innerHeight - CONFIG.planeSize) {
                plane.vy = -plane.vy;
                plane.y = Math.max(0, Math.min(plane.y, window.innerHeight - CONFIG.planeSize));
            }

            // Вычисляем угол поворота по направлению движения
            plane.angle = Math.atan2(plane.vy, plane.vx) + Math.PI / 2;

            // Позиционирование и вращение треугольника
            plane.element.style.left = plane.x + 'px';
            plane.element.style.top = plane.y + 'px';
            plane.element.style.transform = `rotate(${plane.angle}rad)`;

            // Позиционирование метки (над треугольником, без вращения)
            plane.label.style.left = (plane.x + 10) + 'px';
            plane.label.style.top = (plane.y - 40) + 'px';
        });

        requestAnimationFrame(animate);
    }

    animate();
});
