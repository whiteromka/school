<style>
    .network-wrapper {
        position: relative;
        height: 400px;
    }
    .network-wrapper:hover {
        box-shadow: inset 0 0 30px 1px rgba(25, 234, 223, 0.13);
        transition: box-shadow 0s ease;
    }
    #network {
        height: 100%;
    }
    .zoom-controls {
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 10;
        display: flex;
        flex-direction: column;
        pointer-events: auto;
        gap: 6px;
        /*gap: clamp(4px, 1vw, 10px);*/
    }
    .network-btn {
        width: clamp(32px, 8vw, 40px);
        height: clamp(32px, 8vw, 40px);
        background: rgba(0,0,0,.7);
        color: white;
        border: 1px solid #45fff4;
        border-radius: 3px;
        cursor: pointer;
    }
    .network-btn:hover {
        background: yellow;
        color:black;
    }
</style>

<div class="network-wrapper">
    <div id="network"></div>

    <div class="zoom-controls">
        <button class="network-btn" id="js-zoom-in">+</button>
        <button class="network-btn" id="js-zoom-out">-</button>
        <button class="network-btn" id="js-zoom-reset">⟳</button>
        <button class="network-btn" id="js-freeze">❄</button>
    </div>
</div>

<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script>
    let size = 18;
    let colorBackground = "#fc0000";
    let colorBorder = "#45fff4";
    let borderWidth = 2;
    let fontSize = 44;
    let fontColor = "#f9f9f9";
    let fontFace = "Orbitron, monospace"; // ToDo починить

    let eadge = {
        defaultColor: "#898989",
        highlightColor: "#5eead4",
        Color: "#5eead4"
    }

    const nodes = new vis.DataSet([
        // Front группа
        { id: 1, label: "JavaScript", group: "front" },
        { id: 2, label: "HTML", group: "front" },
        { id: 3, label: "CSS", group: "front" },
        { id: '3a', label: "Bootstrap", group: "front" },
        { id: 4, label: "Vue", group: "front" },
        { id: 5, label: "Npm", group: "front" },
        { id: 6, label: "TypeScrip", group: "front" },
        { id: 7, label: "Directives", group: "front" },
        { id: 8, label: "Reactivity", group: "front" },
        { id: 9, label: "Events", group: "front" },
        { id: '9a', label: "Pinia", group: "front" },


        // Back группа
        { id: 10, label: "PHP", group: "back" },
        { id: 11, label: "OOP", group: "back" },
        { id: 12, label: "Laravel", group: "back" },
        { id: 13, label: "Symfony", group: "back" },
        { id: 14, label: "Yii", group: "back" },
        { id: 15, label: "Composer", group: "back" },
        { id: 16, label: "API", group: "back" },
        { id: 17, label: "Request", group: "back" },
        // { id: 18, label: "Controllers", group: "back" },
        // { id: 19, label: "Model Layer", group: "back" },
        { id: 20, label: "Services", group: "back" },
        // { id: 21, label: "Views", group: "back" },
        { id: 22, label: "Auth", group: "back" },
        { id: 23, label: "Queues", group: "back" },
        { id: 24, label: "Tests", group: "back" },
        { id: '24a', label: "PhpUnit", group: "back" },
        { id: '24b', label: "Codeception", group: "back" },
        // { id: 25, label: "Logging / Monitoring", group: "back" },
        { id: 26, label: "Framework", group: "back" },
        { id: 27, label: "Mvc", group: "back" },
        { id: 28, label: "Components", group: "back" },
        { id: 29, label: "Architecture", group: "back" },
        { id: 30, label: "Domain", group: "back" },
        { id: 31, label: "Application", group: "back" },
        { id: 32, label: "Infrastructure", group: "back" },


        // DB группа
        { id: 200, label: "DB", group: "db" },
        { id: '200a', label: "SQL", group: "db" },
        { id: '200b', label: "Caches", group: "db" },
        { id: '200c', label: "Brokers", group: "db" },
        { id: '200d', label: "NoSql", group: "db" },
        { id: '200d1', label: "Elasticsearch", group: "db" },
        { id: 201, label: "MySQL", group: "db" },
        { id: '201a', label: "SQLite", group: "db" },
        { id: 202, label: "PostrgeSQL", group: "db" },
        { id: 203, label: "Redis", group: "db" },
        { id: 204, label: "Memcached", group: "db" },
        { id: 205, label: "Apache Kafka", group: "db" },
        { id: 206, label: "RabbitMQ", group: "db" },

        // X группа
        { id: 50, label: "Git", group: "x" },
        { id: 51, label: "Docker Compose", group: "x" },

        // Eng group
        { id: 100, label: "English", group: "eng" },
        { id: 101, label: "Grammar", group: "eng" },
        { id: 102, label: "Times", group: "eng" },
        { id: 103, label: "Past Simple", group: "eng" },
        { id: 104, label: "Present Simple", group: "eng" },
    ]);

    const edges = new vis.DataSet([
        // Front группа
        { from: 1, to: 2 },
        { from: 1, to: 3 },
        { from: 1, to: 4 },
        { from: 1, to: 5 },
        { from: 1, to: 6 },
        { from: 2, to: 3 },
        { from: 7, to: 4 },
        { from: 8, to: 4 },
        { from: 9, to: 4 },
        { from: '9a', to: 4 },
        { from: '3a', to: 2 },
        { from: '3a', to: 3 },


        // Back группа
        { from: 10, to: 11 },
        // { from: 10, to: 12 },
        // { from: 10, to: 13 },
        // { from: 10, to: 14 },
        { from: 10, to: 15 },
        { from: 12, to: 11 },
        { from: 13, to: 11 },
        { from: 14, to: 11 },
        { from: 10, to: 26 },
        { from: 11, to: 26 },
        { from: 12, to: 26 },
        { from: 13, to: 26 },
        { from: 14, to: 26 },
        //{ from: 26, to: 25 },
        { from: 26, to: 16 },
        { from: 26, to: 27 },
        { from: 27, to: 18 },
        { from: 27, to: 19 },
        { from: 27, to: 21 },
        { from: 26, to: 28 },
        { from: 28, to: 23 },
        { from: 28, to: 22 },
        { from: 28, to: 17 },
        { from: 28, to: 24 },
        { from: 24, to: '24a' },
        { from: 24, to: '24b' },
        { from: 28, to: 20 },
        { from: 26, to: 29 },
        { from: 29, to: 30 },
        { from: 29, to: 31 },
        { from: 29, to: 32 },

        // DB группа
        { from: 200, to: 10 },
        { from: 200, to: '200a' },
        { from: 200, to: '200b' },
        { from: 200, to: '200c' },
        { from: '200a', to: 201 },
        { from: '200a', to: '201a' },
        { from: '200a', to: 202 },
        { from: '200b', to: 203 },
        { from: '200b', to: 204 },
        { from: '200c', to: 205 },
        { from: '200c', to: 206 },
        { from: 200, to: '200d' },
        { from: '200d', to: '200d1'},


        // X группа
        { from: 50, to: 1 },
        { from: 51, to: 1 },
        { from: 50, to: 10 },
        { from: 51, to: 10 },
        { from: 51, to: 200 },

        // Eng group
        { from: 100, to: 101 },
        { from: 101, to: 102 },
        { from: 102, to: 103 },
        { from: 102, to: 104 },
        { from: 100, to: 1 },
        { from: 100, to: 10 },
        { from: 100, to: 200 },

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
            color: { color: eadge.defaultColor, highlight: eadge.highlightColor, hover: eadge.Color },
            width: 1.2,
            selectionWidth: 5,
            hoverWidth: 3,
            smooth: { type: "continuous", roundness: 0.25 }
        },
        groups: {
            front: {
                color: { background: "#4d0000", border: "#e70000", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            back: {
                color: { background: "#034453", border: "#00acea", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            db: {
                color: { background: "#000000", border: "#3a0ecc", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            x: {
                color: { background: "#025444", border: "#14cca1", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            eng: {
                color: { background: "#39067c", border: "#8109c7", highlight: { background: "#ffffff", border: "#ffffff" } }
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

    document.getElementById('js-zoom-in').onclick = () => {
        network.moveTo({
            scale: network.getScale() * 1.2,
            animation: { duration: 300 }
        });
    };
    document.getElementById('js-zoom-out').onclick = () => {
        network.moveTo({
            scale: network.getScale() * 0.8,
            animation: {duration: 300}
        });
    };

    document.getElementById('js-zoom-reset').onclick = () => {
        // Просто перерисовать сеть без изменения позиций и масштаба
        network.stabilize();
    };

    document.getElementById('js-freeze').onclick = () => {
        const btn = document.getElementById('js-freeze');
        network.physics.physicsEnabled = !network.physics.physicsEnabled;

        if (!network.physics.physicsEnabled) {
            btn.style.backgroundColor = 'yellow';
            btn.style.color = 'black';
        } else {
            btn.style.backgroundColor = 'transparent';
            btn.style.color = 'white';
        }
    };

    network.on("click", function (params) {
        if (params.nodes.length > 0) {
            const id = params.nodes[0];
            console.log("ID:", id);
        }
    });
    network.on("dragStart", function (params) {
        if (params.nodes.length > 0) {
            const id = params.nodes[0];
            console.log("Перетаскиваем узел ID:", id);
        }
    });
</script>
