<style>
    #network {
        font-family: 'Orbitron', monospace;
        height: 600px;
        border-radius: 14px;
    }
</style>

<div id="network"></div>

<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script>
    let size = 24;
    let colorBackground = "#fc0000";
    let colorBorder = "#45fff4";
    let borderWidth = 5;
    let fontSize = 43;
    let fontColor = "#f9f9f9";
    let fontFace = "Orbitron, monospace"; // ToDo починить

    const nodes = new vis.DataSet([
        // Левая группа
        { id: 1, label: "JavaScript", group: "left" },
        { id: 2, label: "DOM", group: "left" },
        { id: 3, label: "Async", group: "left" },
        { id: 4, label: "Vue", group: "left" },
        { id: 5, label: "React", group: "left" },

        // Правая группа
        { id: 6, label: "Node", group: "right" },
        { id: 7, label: "Express", group: "right" },
        { id: 8, label: "MongoDB", group: "right" },
        { id: 9, label: "Redis", group: "right" },
        { id: 10, label: "Docker", group: "right" }
    ]);

    const edges = new vis.DataSet([
        { from: 1, to: 2 },
        { from: 1, to: 3 },
        { from: 2, to: 4 },
        { from: 1, to: 5 },
        { from: 5, to: 6 },

        { from: 6, to: 7 },
        { from: 7, to: 8 },
        { from: 8, to: 9 },
        { from: 9, to: 10 }
    ]);

    // Переменные для анимации гравитации
    let currentGravity = 0.001;
    const gravityIncrement = 0.0001;
    let animationInterval = null;
    let isAnimating = false;

    const options = {
        physics: {
            enabled: true,
            solver: "forceAtlas2Based",
            forceAtlas2Based: {
                gravitationalConstant: -60,
                centralGravity: currentGravity,
                springLength: 180,
                springConstant: 0.05,
                damping: 0.6,
                avoidOverlap: 1
            },
            stabilization: { iterations: 200, fit: true }
        },
        nodes: {
            shape: "dot",
            size: size,
            color: {
                background: colorBackground,
                border: colorBorder,
                highlight: { background: "#ffffff", border: "#ffffff" }
            },
            borderWidth: borderWidth,
            font: {
                color: fontColor,
                size: fontSize,
                strokeWidth: 4,
                strokeColor: "#151515"
            }
        },
        edges: {
            color: { color: "#334155", highlight: "#5eead4", hover: "#5eead4" },
            width: 1.2,
            selectionWidth: 5,
            hoverWidth: 3,
            smooth: { type: "continuous", roundness: 0.25 }
        },
        groups: {
            left: {
                color: { background: "#fc0000", border: "#45fff4", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            right: {
                color: { background: "#00ffb3", border: "#00cc99", highlight: { background: "#ffffff", border: "#ffffff" } }
            }
        },
        interaction: { hover: true, zoomSpeed: 0.6 }
    };

    // Создаем сеть
    const network = new vis.Network(
        document.getElementById("network"),
        { nodes, edges },
        options
    );

    // Функции для управления гравитацией
    function updateGravity() {
        currentGravity += gravityIncrement;

        network.setOptions({
            physics: {
                forceAtlas2Based: {
                    centralGravity: currentGravity
                }
            }
        });

        updateGravityDisplay();
        console.log(`centralGravity обновлен: ${currentGravity.toFixed(3)}`);
    }

    function startGravityAnimation() {
        if (isAnimating) return;

        isAnimating = true;
        if (animationInterval) {
            clearInterval(animationInterval);
        }

        animationInterval = setInterval(updateGravity, 100);
        updateControlButtons();
        console.log("Анимация гравитации запущена");
    }

    function stopGravityAnimation() {
        if (!isAnimating) return;

        isAnimating = false;
        if (animationInterval) {
            clearInterval(animationInterval);
            animationInterval = null;
        }

        updateControlButtons();
        console.log("Анимация гравитации остановлена");
    }

    function resetGravity() {
        stopGravityAnimation();
        currentGravity = 0.001;

        network.setOptions({
            physics: {
                forceAtlas2Based: {
                    centralGravity: currentGravity
                }
            }
        });

        updateGravityDisplay();
        updateControlButtons();
        console.log("centralGravity сброшен: 0.001");
    }

    function updateGravityDisplay() {
        const gravityValue = document.getElementById('gravityValue');
        if (gravityValue) {
            gravityValue.textContent = currentGravity.toFixed(3);
        }
    }

    function updateControlButtons() {
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');

        if (startBtn && stopBtn) {
            if (isAnimating) {
                startBtn.disabled = true;
                startBtn.style.opacity = '0.6';
                stopBtn.disabled = false;
                stopBtn.style.opacity = '1';
            } else {
                startBtn.disabled = false;
                startBtn.style.opacity = '1';
                stopBtn.disabled = true;
                stopBtn.style.opacity = '0.6';
            }
        }
    }

    // Создаем панель управления
    function createControlPanel() {
        const container = document.getElementById('network').parentNode;

        const controlPanel = document.createElement('div');
        controlPanel.id = 'gravityControlPanel';
        controlPanel.style.cssText = `
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(2, 6, 23, 0.85);
            padding: 20px;
            border-radius: 12px;
            color: white;
            font-family: 'Segoe UI', Arial, sans-serif;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(69, 255, 244, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            min-width: 280px;
        `;

        controlPanel.innerHTML = `
            <h3 style="margin-top: 0; margin-bottom: 15px; color: #45fff4; font-size: 18px; font-weight: 600;">
               Грави тест
            </h3>

            <div style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="color: #f9f9f9; font-size: 14px;">Текущее значение:</span>
                    <span id="gravityValue" style="color: #00ffb3; font-size: 24px; font-weight: bold; font-family: 'Orbitron', monospace;">
                        ${currentGravity.toFixed(3)}
                    </span>
                </div>
                <div style="background: rgba(255, 255, 255, 0.1); height: 4px; border-radius: 2px; margin: 10px 0;">
                    <div id="gravityBar" style="background: linear-gradient(90deg, #fc0000, #45fff4); height: 100%; width: ${(currentGravity / 2) * 100}%; border-radius: 2px;"></div>
                </div>
                <div style="color: #94a3b8; font-size: 12px; text-align: right;">
                    Шаг увеличения: ${gravityIncrement}
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
                <button id="startBtn" style="padding: 12px; background: linear-gradient(135deg, #00ffb3, #00cc99);
                    border: none; border-radius: 8px; color: #020617; font-weight: bold; cursor: pointer;
                    font-size: 14px; transition: all 0.3s;">
                    ▶ Старт
                </button>
                <button id="stopBtn" style="padding: 12px; background: linear-gradient(135deg, #fc0000, #cc0000);
                    border: none; border-radius: 8px; color: white; font-weight: bold; cursor: pointer;
                    font-size: 14px; transition: all 0.3s;" disabled>
                    ⏸ Стоп
                </button>
            </div>

            <div style="display: flex; gap: 10px;">
                <button id="resetBtn" style="flex: 1; padding: 12px; background: rgba(69, 255, 244, 0.1);
                    border: 1px solid rgba(69, 255, 244, 0.3); border-radius: 8px; color: #45fff4;
                    font-weight: bold; cursor: pointer; font-size: 14px; transition: all 0.3s;">
                    Сброс
                </button>
                <button id="infoBtn" style="width: 40px; padding: 12px; background: rgba(255, 255, 255, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; color: white;
                    cursor: pointer; font-size: 14px; transition: all 0.3s;">
                    ℹ
                </button>
            </div>

            <div id="infoPanel" style="margin-top: 15px; padding: 12px; background: rgba(0, 0, 0, 0.3);
                border-radius: 6px; font-size: 12px; color: #94a3b8; display: none; border-left: 3px solid #45fff4;">
                <strong>Эффекты centralGravity:</strong><br>
                • < 0.1: Слабая гравитация, узлы свободны<br>
                • 0.1-0.5: Умеренное притяжение<br>
                • > 0.5: Сильное притяжение к центру
            </div>
        `;

        container.appendChild(controlPanel);

        // Добавляем обработчики кнопок
        document.getElementById('startBtn').addEventListener('click', startGravityAnimation);
        document.getElementById('stopBtn').addEventListener('click', stopGravityAnimation);
        document.getElementById('resetBtn').addEventListener('click', resetGravity);
        document.getElementById('infoBtn').addEventListener('click', function() {
            const infoPanel = document.getElementById('infoPanel');
            infoPanel.style.display = infoPanel.style.display === 'none' ? 'block' : 'none';
        });

        updateControlButtons();
    }

    // Обновляем индикатор гравитации
    function updateGravityBar() {
        const gravityBar = document.getElementById('gravityBar');
        if (gravityBar) {
            const widthPercent = Math.min((currentGravity / 2) * 100, 100);
            gravityBar.style.width = `${widthPercent}%`;

            // Меняем цвет в зависимости от значения
            if (currentGravity < 0.5) {
                gravityBar.style.background = 'linear-gradient(90deg, #fc0000, #45fff4)';
            } else if (currentGravity < 1) {
                gravityBar.style.background = 'linear-gradient(90deg, #45fff4, #00ffb3)';
            } else {
                gravityBar.style.background = 'linear-gradient(90deg, #00ffb3, #ffffff)';
            }
        }
    }

    // События сети
    network.once("stabilizationIterationsDone", function () {
        setTimeout(() => {
            createControlPanel();
            console.log("Сеть стабилизирована. Панель управления создана.");
        }, 500);
    });

    network.on("afterDrawing", () => {
        nodes.forEach(node => {
            if (node.group === "left" && node.x > 0) {
                nodes.update({ id: node.id, x: node.x - 300 });
            }
            if (node.group === "right" && node.x < 0) {
                nodes.update({ id: node.id, x: node.x + 300 });
            }
        });
    });

    // Обновляем отображение гравитации
    network.on('beforeDrawing', function() {
        updateGravityDisplay();
        updateGravityBar();
    });

    network.on("click", function (params) {
        if (params.nodes.length > 0) {
            const nodeId = params.nodes[0];
            const node = nodes.get(nodeId);
            console.log("Клик на узле:", node.id, node.label);

            // Визуальная обратная связь при клике
            network.selectNodes([nodeId]);
            setTimeout(() => {
                network.unselectAll();
            }, 500);
        }
    });

    network.on("dragStart", function (params) {
        if (params.nodes.length > 0) {
            const nodeId = params.nodes[0];
            const node = nodes.get(nodeId);
            console.log(`Перетаскивание узла: ${node.label}`);
        }
    });

    // Добавляем стили для кнопок при наведении
    document.addEventListener('DOMContentLoaded', function() {
        const style = document.createElement('style');
        style.textContent = `
            #gravityControlPanel button:hover:not(:disabled) {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            #gravityControlPanel button:active:not(:disabled) {
                transform: translateY(0);
            }

            #gravityControlPanel button:disabled {
                cursor: not-allowed;
                opacity: 0.6;
            }
        `;
        document.head.appendChild(style);
    });

    // Экспортируем функции для использования в консоли браузера
    window.gravityControls = {
        start: startGravityAnimation,
        stop: stopGravityAnimation,
        reset: resetGravity,
        getCurrent: () => currentGravity,
        setValue: (value) => {
            currentGravity = value;
            network.setOptions({
                physics: {
                    forceAtlas2Based: {
                        centralGravity: currentGravity
                    }
                }
            });
            updateGravityDisplay();
            updateGravityBar();
        }
    };
</script>
