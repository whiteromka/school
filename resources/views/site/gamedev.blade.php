@extends('layouts.main')

@section('title', 'Курсы по программированию на php')

@section('content')

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;

        }

        .wrapper {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            background: #141414;
        }

        #map-container {
            position: absolute;
            width: 400px;
            height: 500px;
            cursor: grab;
            user-select: none;
        }

        #map-container.dragging {
            cursor: grabbing;
        }

        /* Карта обесцвечена */
        #map {
            width: 100%;
            height: 100%;
            filter: grayscale(100%);
            opacity: 0.4;
        }

        /* Слой с линиями и маркерами поверх карты */
        #layers {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none; /* чтобы карта оставалась интерактивной */
        }

        .info {
            padding: 10px;
            background: #f5f5f5;
        }
    </style>

    <div class="wrapper">
        <div id="map-container">
            <div class="info">
                <b>Город:</b> <span id="city">Определяем...</span>
            </div>
            <div id="map"></div>
            <div id="layers"></div>
        </div>
    </div>

    @push('scripts')
        <!-- Yandex Maps -->
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
        <script>
            // Перетаскивание #map-container
            (function() {
                const container = document.getElementById('map-container');
                const wrapper = document.querySelector('.wrapper');
                let isDragging = false;
                let startX, startY, startLeft, startTop;

                container.addEventListener('mousedown', function(e) {
                    // Не перетаскиваем, если кликнули по карте (для взаимодействия с картой)
                    if (e.target.closest('#map')) {
                        return;
                    }

                    isDragging = true;
                    container.classList.add('dragging');

                    startX = e.clientX;
                    startY = e.clientY;

                    const rect = container.getBoundingClientRect();
                    const wrapperRect = wrapper.getBoundingClientRect();

                    startLeft = rect.left - wrapperRect.left;
                    startTop = rect.top - wrapperRect.top;

                    e.preventDefault();
                });

                document.addEventListener('mousemove', function(e) {
                    if (!isDragging) return;

                    const dx = e.clientX - startX;
                    const dy = e.clientY - startY;

                    let newLeft = startLeft + dx;
                    let newTop = startTop + dy;

                    // Ограничиваем перемещение пределами wrapper
                    const wrapperRect = wrapper.getBoundingClientRect();
                    const containerRect = container.getBoundingClientRect();

                    // Левая и правая границы
                    if (newLeft < 0) newLeft = 0;
                    if (newLeft + containerRect.width > wrapperRect.width) {
                        newLeft = wrapperRect.width - containerRect.width;
                    }

                    // Верхняя и нижняя границы
                    if (newTop < 0) newTop = 0;
                    if (newTop + containerRect.height > wrapperRect.height) {
                        newTop = wrapperRect.height - containerRect.height;
                    }

                    container.style.left = newLeft + 'px';
                    container.style.top = newTop + 'px';
                });

                document.addEventListener('mouseup', function() {
                    isDragging = false;
                    container.classList.remove('dragging');
                });
            })();

            (async function () {

                async function getGeo() {
                    const res = await fetch('https://ipapi.co/json/');
                    return await res.json();
                }

                const geo = await getGeo();

                const lat = geo.latitude;
                const lon = geo.longitude;
                const city = geo.city;

                ymaps.ready(init);

                function init() {

                    // 1️⃣ создаем карту
                    const map = new ymaps.Map("map", {
                        center: [lat, lon],
                        zoom: 3,
                        controls: ['zoomControl', 'fullscreenControl']
                    });

                    // 2️⃣ создаем коллекции для линий и маркеров
                    const gridCollection = new ymaps.GeoObjectCollection();
                    const labelCollection = new ymaps.GeoObjectCollection();
                    const mainCollection = new ymaps.GeoObjectCollection();

                    map.geoObjects.add(gridCollection);
                    map.geoObjects.add(labelCollection);
                    map.geoObjects.add(mainCollection);

                    // 3️⃣ функция отрисовки сетки
                    function drawGrid() {
                        gridCollection.removeAll();
                        labelCollection.removeAll();

                        const bounds = map.getBounds();
                        const south = bounds[0][0];
                        const west  = bounds[0][1];
                        const north = bounds[1][0];
                        const east  = bounds[1][1];

                        const zoom = map.getZoom();
                        let step = (zoom < 5) ? 10 : (zoom < 7) ? 5 : (zoom < 10) ? 1 : 0.5;

                        // горизонтальные линии
                        for (let latLine = Math.floor(south); latLine <= north; latLine += step) {
                            const line = new ymaps.Polyline([[latLine, west],[latLine, east]], {}, {
                                strokeColor: "#ff0000",
                                strokeWidth: 1,
                                opacity: 1
                            });
                            gridCollection.add(line);

                            const label = new ymaps.Placemark([latLine, west], {
                                iconContent: latLine.toFixed(2)
                            }, {
                                preset: 'islands#redStretchyIcon',
                                iconColor: '#ff0000',
                                draggable: false
                            });
                            labelCollection.add(label);
                        }

                        // вертикальные линии
                        for (let lonLine = Math.floor(west); lonLine <= east; lonLine += step) {
                            const line = new ymaps.Polyline([[south, lonLine],[north, lonLine]], {}, {
                                strokeColor: "#ff0000",
                                strokeWidth: 1,
                                opacity: 1
                            });
                            gridCollection.add(line);

                            const label = new ymaps.Placemark([south, lonLine], {
                                iconContent: lonLine.toFixed(2)
                            }, {
                                preset: 'islands#redStretchyIcon',
                                iconColor: '#ff0000',
                                draggable: false
                            });
                            labelCollection.add(label);
                        }
                    }

                    drawGrid();

                    map.events.add('boundschange', function () {
                        drawGrid();
                    });

                    // 4️⃣ Анимация зума
                    setTimeout(() => {
                        map.setCenter([lat, lon], 6, { duration: 2000 });
                    }, 3000);

                    setTimeout(() => {
                        map.setCenter([lat, lon], 10, { duration: 2000 });
                    }, 6000);

                    //5️⃣ Маркер и круг
                    setTimeout(() => {
                        const placemark = new ymaps.Placemark([lat, lon], {
                            balloonContent: city
                        }, {
                            preset: 'islands#redIcon'
                        });

                        const circle = new ymaps.Circle([
                            [lat, lon],
                            10000
                        ], {}, {
                            fillColor: "#ff000055",
                            strokeColor: "#ff0000",
                            strokeWidth: 2
                        });

                        mainCollection.add(circle);
                       // mainCollection.add(placemark);

                        document.getElementById('city').innerText = city + ' - ' + lat + ' - ' + lon;
                    }, 9000);

                }

            })();
        </script>
    @endpush
@endsection
