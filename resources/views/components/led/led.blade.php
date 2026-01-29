<div class="container-fluid top-ark bg-pink"></div>
<div class="container-fluid px-0 bg-pink">
    <div class="row">
        <br>
    </div>
    <div class="row">
        <div class="col-md-4 d-flex flex-column p-l-50">
            <p>Для студентов</p>
            <p><a href="">222 2 2 22 </a></p>
            <p><a href=""> 3 3 3  3333  3 3</a></p>
        </div>
        <div class="col-md-4 br-r_ d-f-c">
            {{-- <canvas id="led"></canvas>--}}
            <br>
            <br>
            <br>
        </div>
        <div class="col-md-4 br-r_">
            <p>Для бизнеса:</p>
            <p><a href="#">Разработка и автоматизация процессов</a></p>
            <p><a href="#"> 3 3 3  3333  3 3</a></p>
        </div>
    </div>
</div>


<script>
    let text = "HELLO FRIEND"
    const pixelSize = 2  // Размер одного пикселя на LED-панели
    const gap = 1  // Расстояние между пикселями
    const cols = 160
    const rows = 14

    // Начальные координаты текста
    let x = 10
    let y = 0
    let letterOffset = 11 // Расстояние между символами

    const canvas = document.getElementById("led")
    canvas.width = cols * (pixelSize + gap)  // Устанавливаем ширину canvas с учётом пикселей и gaps
    canvas.height = rows * (pixelSize + gap) // Устанавливаем высоту canvas с учётом пикселей и gaps
    // Контекст рисования 2D
    const ctx = canvas.getContext("2d")

    // Создаём offscreen canvas, чтобы сначала отрисовать текст
    const off = document.createElement("canvas")
    off.width = cols
    off.height = rows
    const offCtx = off.getContext("2d")

    // Заливаем offscreen canvas чёрным фоном
    offCtx.fillStyle = "#000"
    offCtx.fillRect(0, 0, cols, rows)

    // Цвет текста (будет белым на offscreen)
    offCtx.fillStyle = "#fff"
    offCtx.font = "18px Consolas" // Шрифт для отрисовки текста
    offCtx.textBaseline = "top"  // Выравнивание текста по верхнему краю


    // Проходим по каждому символу текста и рисуем его на offscreen canvas
    for (const ch of text) {
        offCtx.fillText(ch, x, y)
        x += letterOffset // сдвигаем X для следующей буквы
    }

    // Получаем массив пиксельных данных с offscreen canvas
    const data = offCtx.getImageData(0, 0, cols, rows).data

    // Основной цикл по строкам LED-панели
    for (let y = 0; y < rows; y++) {
        // Внутренний цикл по колонкам LED-панели
        for (let x = 0; x < cols; x++) {
            // Индекс пикселя в массиве ImageData (4 значения на пиксель: RGBA)
            const i = (y * cols + x) * 4
            // Проверяем, есть ли белый пиксель в offscreen canvas
            const on = data[i] > 0

            // Вычисляем коэффициент яркости по горизонтали для эффекта затемнения краёв
            let fade = 1
            const edgeWidth = 25 // сколько колонок затемняем слева и справа
            if (x < edgeWidth) fade = x / edgeWidth // слева
            else if (x >= cols - edgeWidth) fade = (cols - x - 1) / edgeWidth // справа

            // Ограничиваем коэффициент яркости между 0 и 1
            fade = Math.max(0, Math.min(1, fade))

            // функция для перевода hex в RGB-массив
            function hexToRgb(hex) {
                hex = hex.replace("#", "")
                return [
                    parseInt(hex.substring(0, 2), 16),
                    parseInt(hex.substring(2, 4), 16),
                    parseInt(hex.substring(4, 6), 16)
                ]
            }
            // выбираем цвет в hex
            // const baseHex = on ? "#00ff64" : "#11432d"
            const baseHex = on ? "#ff4747" : "#431111"

            // переводим hex в RGB
            const baseColor = hexToRgb(baseHex)

            // применяем коэффициент fade к каждому каналу
            ctx.fillStyle = `rgb(
                ${Math.round(baseColor[0] * fade)},
                ${Math.round(baseColor[1] * fade)},
                ${Math.round(baseColor[2] * fade)}
            )`

            // рисуем LED-пиксель
            ctx.fillRect(
                x * (pixelSize + gap),
                y * (pixelSize + gap),
                pixelSize,
                pixelSize
            )
        }
    }
</script>
