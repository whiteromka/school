/**
 * Анимация медленно летающих зеленых треугольников (как самолеты на радаре)
 * Внутри элемента .grid-background
 * С трассировкой следа
 */

// Настройки
const CONFIG = {
    maxPlanes: 2,              // Количество треугольников
    planeSize: 50,             // Размер для расчёта границ
    baseSpeed: 0.2,            // Базовая скорость
    directionChangeInterval: 2500, // Средний интервал смены направления (мс)
    directionChangeChance: 0.05,   // Шанс смены направления
    // 8 направлений: 0°, 45°, 90°, 135°, 180°, 225°, 270°, 315°
    directions: [0, 45, 90, 135, 180, 225, 270, 315],
    spawnDelay: 7000           // Задержка между появлением самолётов (мс)
};

// Настройки следа
const TRAIL = {
    length: 80,           // Длина следа (количество точек)
    updateInterval: 4000,  // Как часто добавлять точку в след (мс)
    fadeTime: 80000        // Время исчезновения следа (мс)
};

// Генератор случайных имён
const NAMES = {
    prefixes: ['ALFA', 'BRAVO', 'WHISKEY', 'FOXTROT'],
    suffixes: [' 01', ' 02', ' 03', ' 04', ' 05', ' 06', ' 07', ' 08', ' 09', ' 10']
};

// Настройки стилей
const STYLES = {
    plane: {
        opacity: '0.4',
        className: 'radar-plane'
    },
    label: {
        className: 'radar-plane-label',
        offsetLeft: 10,
        offsetTop: -40
    },
    svg: {
        position: 'absolute',
        top: '0',
        left: '0',
        pointerEvents: 'none',
        zIndex: '0'
    },
    trail: {
        fill: 'none',
        stroke: 'rgba(085,085,085,0.81)',
        strokeWidth: '1',
        strokeLinecap: 'round',
        dasharray: '10 10',
        opacity: '0.4',
        filter: 'drop-shadow(0 0 3px #00ff00)'
    }
};

// Настройки поворотов
const TURN_OPTIONS = [-45, 45, -90, 90];

// Настройки треугольника
const PLANE_GEOMETRY = {
    trailXOffset: 10,
    trailYOffset: 11,
    angleOffset: Math.PI / 2
};

// Генерация рандомного имени
function generateRandomName() {
    const prefix = NAMES.prefixes[Math.floor(Math.random() * NAMES.prefixes.length)];
    const suffix = NAMES.suffixes[Math.floor(Math.random() * NAMES.suffixes.length)];
    return prefix + suffix;
}

// Генерация рандомного статуса
function generateRandomStatus() {
    return Math.random() < 0.5 ? 'online' : 'offline';
}

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('gridBackground');
    if (!container) {
        console.warn('Контейнер #gridBackground не найден');
        return;
    }

    const planes = [];

    // Создание SVG для следов
    function createSvg() {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('width', '100%');
        svg.setAttribute('height', '100%');
        svg.style.position = STYLES.svg.position;
        svg.style.top = STYLES.svg.top;
        svg.style.left = STYLES.svg.left;
        svg.style.pointerEvents = STYLES.svg.pointerEvents;
        svg.style.zIndex = STYLES.svg.zIndex;
        container.appendChild(svg);
        return svg;
    }
    const svg = createSvg();

    // Создания самолёта
    function createPlane(index) {
        const element = document.createElement('div');
        element.className = STYLES.plane.className;
        element.style.opacity = STYLES.plane.opacity;
        container.appendChild(element);

        // Создаём метку с случайным именем и статусом
        const label = document.createElement('div');
        label.className = STYLES.label.className;
        const planeName = generateRandomName();
        const status = generateRandomStatus();
        label.innerHTML = `
            <span class="group-name">${planeName}</span>
            <span class="status ${status}">${status.toUpperCase()}</span>`;
        container.appendChild(label);

        // Выбираем случайное направление
        const randomDirIndex = Math.floor(Math.random() * CONFIG.directions.length);
        const angle = CONFIG.directions[randomDirIndex] * Math.PI / 180;
        const speed = CONFIG.baseSpeed * (0.8 + Math.random() * 0.4);

        // Создаём путь для следа
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill', STYLES.trail.fill);
        path.setAttribute('stroke', STYLES.trail.stroke);
        path.setAttribute('stroke-width', STYLES.trail.strokeWidth);
        path.setAttribute('stroke-linecap', STYLES.trail.strokeLinecap);
        path.setAttribute('stroke-dasharray', STYLES.trail.dasharray);
        path.setAttribute('opacity', STYLES.trail.opacity);
        path.style.filter = STYLES.trail.filter;
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

    // Запуска появления самолётов
    function startSpawnPlanes() {
        for (let i = 0; i < CONFIG.maxPlanes; i++) {
            setTimeout(() => {
                createPlane(i);
            }, CONFIG.spawnDelay * (i + 1));
        }
    }

    if (!window.common.isActionName('gamedev')) {
        startSpawnPlanes();
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
                    plane.element.style.opacity = STYLES.plane.opacity;
                }, 200);

                // Добавляем точку в след (по центру треугольника)
                const trailX = plane.x + PLANE_GEOMETRY.trailXOffset;
                const trailY = plane.y + PLANE_GEOMETRY.trailYOffset;
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
                    const randomTurn = TURN_OPTIONS[Math.floor(Math.random() * TURN_OPTIONS.length)];
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
            plane.angle = Math.atan2(plane.vy, plane.vx) + PLANE_GEOMETRY.angleOffset;

            // Позиционирование и вращение треугольника
            plane.element.style.left = plane.x + 'px';
            plane.element.style.top = plane.y + 'px';
            plane.element.style.transform = `rotate(${plane.angle}rad)`;

            // Позиционирование метки (над треугольником, без вращения)
            plane.label.style.left = (plane.x + STYLES.label.offsetLeft) + 'px';
            plane.label.style.top = (plane.y + STYLES.label.offsetTop) + 'px';
        });

        requestAnimationFrame(animate);
    }

    animate();
});
