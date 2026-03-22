document.addEventListener('DOMContentLoaded', function () {

    // ================= CONFIG =================
    const CONFIG = {
        square: {
            blinkDuration: 3000,
            blinkInterval: 300,
        },
        menu: {
            lineDelay: 300,
            menuDelay: 5000,
            blinkDuration: 2000,
            blinkInterval: 350,
        },
        loop: {
            delayBetweenRuns: 2000,
        }
    };


    // ================= GRID =================
    const gridBackground = document.getElementById('gridBackground');
    const squareSize = 160;

    let points = [];

    function createGrid() {
        gridBackground.innerHTML = '';
        points = [];

        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        const squaresHorizontal = Math.ceil(windowWidth / squareSize) + 1;
        const squaresVertical = Math.ceil(windowHeight / squareSize) + 1;
        const totalSquares = squaresHorizontal * squaresVertical;

        for (let i = 0; i < totalSquares; i++) {
            const square = document.createElement('div');
            square.className = 'grid-square';

            const point = document.createElement('div');
            point.className = 'grid-point';

            square.appendChild(point);
            gridBackground.appendChild(square);

            points.push(point);
        }
    }

    createGrid();
    window.addEventListener('resize', createGrid);

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    function sleep(ms) {
        return new Promise(r => setTimeout(r, ms));
    }

    function generateStats(index) {
        return [
            `ID: ${index}`,
            `X: ${getRandomInt(window.innerWidth)}`,
            `Y: ${getRandomInt(window.innerHeight)}`,
            `Load: ${(Math.random() * 100).toFixed(1)}%`,
            `Signal: ${getRandomInt(100)}%`,
            `Noise: ${(Math.random() * 10).toFixed(2)}`
        ];
    }


    // Мигание
    function blinkSquare(square) {
        return new Promise(resolve => {
            let active = false;

            const interval = setInterval(() => {
                active = !active;
                square.classList.toggle('active', active);
            }, CONFIG.square.blinkInterval);

            setTimeout(() => {
                clearInterval(interval);
                square.classList.remove('active');
                resolve();
            }, CONFIG.square.blinkDuration);
        });
    }

    function blinkElement(el) {
        return new Promise(resolve => {
            let visible = true;

            const interval = setInterval(() => {
                el.style.opacity = visible ? '0.2' : '1';
                visible = !visible;
            }, CONFIG.menu.blinkInterval);

            setTimeout(() => {
                clearInterval(interval);
                el.style.opacity = '1';
                resolve();
            }, CONFIG.menu.blinkDuration);
        });
    }


    // Отображение инфо квадрата
    async function showDebugMenu(stats, square) {

        //  создаём меню ВНУТРИ квадрата
        const menu = document.createElement('div');
        menu.className = 'debug-menu';

        // растягиваем на весь квадрат
        menu.style.position = 'absolute';
        menu.style.top = '0';
        menu.style.left = '0';
        menu.style.width = '100%';
        menu.style.height = '100%';

        square.appendChild(menu);

        //  печать строк
        for (let stat of stats) {
            const line = document.createElement('div');
            line.textContent = stat;
            line.className = 'debug-line';
            menu.appendChild(line);

            await sleep(CONFIG.menu.lineDelay);
        }

        //  пауза
        await sleep(CONFIG.menu.menuDelay);

        //  мигание
        await blinkElement(menu);

        //  удаляем меню
        square.removeChild(menu);
    }


    // Мигание определение характеристик
    async function runSequence() {
        if (!points.length) return;

        const index = getRandomInt(points.length);
        const square = points[index].parentElement;

        await blinkSquare(square);

        const stats = generateStats(index);
        await showDebugMenu(stats, square);
    }


    // Loop
    async function loop() {
        while (true) {
            await runSequence();
            await sleep(CONFIG.loop.delayBetweenRuns);
        }
    }


    let loopStarted = false;
    function checkAndStartLoop() {
        if (!loopStarted && window.innerWidth > 1200) {
            loopStarted = true;
            loop();
        }
    }
    checkAndStartLoop();
    window.addEventListener('resize', checkAndStartLoop);
});
