<style>
    #game {
        background: rgba(255, 255, 255, 0.25);
        image-rendering:pixelated;
        border:2px solid #333;
    }
</style>

<canvas id="game" width="250" height="200"></canvas>

<script>
    const canvas = document.getElementById('game');
    const ctx = canvas.getContext('2d');

    // ─── CONFIG ──────────────────
    const SCALE = 3;
    const GROUND_Y = 146 + 2 * SCALE;
    const SPEED = 3;
    const GRAVITY = 0.7;
    const JUMP_FORCE = -10;

    // Clouds
    const CLOUD_MIN = 7;
    const CLOUD_MAX = 15;
    const CLOUD_SPEED = 0.5;
    const CLOUD_Y_MIN = 20;
    const CLOUD_Y_MAX = 100;

    // ─── SPRITES ─────────────────
    const dinoFrames = [
        [
            "   ████  ██",
            " █████████",
            "████████",
            "  █   █",
            "   █ █ "
        ],
        [
            "   ███  ██",
            "  ████████ ",
            "███████",
            "  █  █",
            " █    █ "
        ]
    ];

    const cactus = [
        " ██ ",
        " ██ ",
        "████"
    ];

    // ─── HELPERS ─────────────────
    const g_size = s => ({
        w: s[0].length * SCALE,
        h: s.length * SCALE
    });

    function draw(sprite, x, y) {
        ctx.fillStyle = '#333';
        sprite.forEach((row, ry) =>
            [...row].forEach((c, rx) => {
                if (c === '█') {
                    ctx.fillRect(
                        x + rx * SCALE,
                        y + ry * SCALE,
                        SCALE,
                        SCALE
                    );
                }
            })
        );
    }

    // ─── STATE ───────────────────
    let dino = { x:50, y:GROUND_Y, vy:0, jumping:false };
    const dinoSize = g_size(dinoFrames[0]);
    const cactusSize = g_size(cactus);

    let obstacles = [];
    let clouds = [];
    let tick = 0;
    let score = 0;
    let gameOver = false;

    // ─── LOGIC ───────────────────
    function spawnCactus() {
        obstacles.push({
            x: canvas.width,
            y: GROUND_Y + 2 * SCALE,
            passed: false // для счётчика
        });
    }

    function spawnCloud() {
        const len =
            (CLOUD_MIN + Math.random() * (CLOUD_MAX - CLOUD_MIN)) | 0;

        clouds.push({
            x: canvas.width,
            y: CLOUD_Y_MIN + Math.random() * (CLOUD_Y_MAX - CLOUD_Y_MIN),
            w: len * SCALE
        });
    }

    function update() {
        if (gameOver) return;

        // Dino physics
        if (dino.jumping) {
            dino.vy += GRAVITY;
            dino.y += dino.vy;
            if (dino.y >= GROUND_Y) {
                dino.y = GROUND_Y;
                dino.vy = 0;
                dino.jumping = false;
            }
        }

        // Clouds
        clouds.forEach(c => c.x -= CLOUD_SPEED);
        clouds = clouds.filter(c => c.x > -c.w);
        if (tick % 180 === 0) spawnCloud();

        // Obstacles
        obstacles.forEach(o => o.x -= SPEED);
        obstacles = obstacles.filter(o => o.x > -50);
        if (tick % 120 === 0) spawnCactus();

        // Collision & score
        obstacles.forEach(o => {
            // Game Over
            if (
                dino.x < o.x + cactusSize.w &&
                dino.x + dinoSize.w > o.x &&
                dino.y < o.y + cactusSize.h &&
                dino.y + dinoSize.h > o.y
            ) {
                gameOver = true;
            }

            // Score (прошли кактус)
            if (!o.passed && o.x + cactusSize.w < dino.x) {
                score++;
                o.passed = true;
            }
        });

        tick++;
    }

    function render() {
        ctx.clearRect(0,0,canvas.width,canvas.height);

        // Clouds
        ctx.fillStyle = '#bbb';
        clouds.forEach(c =>
            ctx.fillRect(c.x, c.y, c.w, SCALE)
        );

        // Ground
        ctx.fillStyle = '#999';
        ctx.fillRect(0, GROUND_Y + dinoSize.h, canvas.width, 2);

        // Dino
        draw(
            dinoFrames[Math.floor(tick / 10) % dinoFrames.length],
            dino.x,
            dino.y
        );

        // Cactus
        obstacles.forEach(o => draw(cactus, o.x, o.y));

        // Score
        ctx.fillStyle = '#000';
        ctx.font = '16px monospace';
        ctx.fillText('Score: ' + score, 10, 20);

        // Game Over
        if (gameOver) {
            ctx.fillStyle = 'red';
            ctx.font = '20px monospace';
            ctx.fillText('GAME OVER', 60, 120);
            ctx.font = '14px monospace';
            ctx.fillText('Click to restart', 60, 140);
        }
    }

    function loop() {
        update();
        render();
        requestAnimationFrame(loop);
    }

    // ─── CONTROLS ─────────────────
    canvas.addEventListener('mousedown', () => {
        if (gameOver) {
            // Restart game
            dino = { x:50, y:GROUND_Y, vy:0, jumping:false };
            obstacles = [];
            clouds = [];
            tick = 0;
            score = 0;
            gameOver = false;
        } else if (!dino.jumping) {
            dino.vy = JUMP_FORCE;
            dino.jumping = true;
        }
    });

    // Запуск
    loop();
</script>

