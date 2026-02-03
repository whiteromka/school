<style>
    .logos-container {
        width: 100%;
        overflow: hidden;
        background-color: #1a1a1a;
        padding: 30px 0;
        position: relative;
        border-radius: 12px;
    }

    .logos-container::before,
    .logos-container::after {
        content: '';
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .logos-container::before {
        left: 0;
        background: linear-gradient(to right, #1a1a1a 0%, transparent 100%);
    }

    .logos-container::after {
        right: 0;
        background: linear-gradient(to left, #1a1a1a 0%, transparent 100%);
    }

    .logos-track {
        display: flex;
        width: max-content;
        animation: scroll 40s linear infinite;
    }

    .logo-item {
        padding: 0 20px;
        flex-shrink: 0;
        min-width: 100px;
        max-width: 180px;
        height: 100px;
        margin: 0 20px;
        background-color: #2a2a2a;
        border-radius: 3px;
        border: 1px solid #393939;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-icon {
        font-size: 2.5rem;
        color: #fff;
        filter: brightness(1.1);
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-2%);
        }
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .logo-item {
            width: 140px;
            height: 90px;
            margin: 0 15px;
        }

        .logos-container::before,
        .logos-container::after {
            width: 80px;
        }

    }

    @media (max-width: 480px) {
        .logo-item {
            width: 120px;
            height: 80px;
            margin: 0 10px;
        }

        .logo-icon {
            font-size: 2rem;
        }
    }

    .logo-image {
        max-width: 100%;
        max-height: 70px;
        object-fit: contain;
        transition: transform 0.3s ease, filter 0.9s ease;
        filter: grayscale(100%); /* Черно-белые по умолчанию */
    }

    .logo-item:hover .logo-image {
        filter: grayscale(0%); /* Цветные при наведении */
    }

    /* Стиль для запасного варианта, если изображение не загрузилось */
    .logo-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #333, #444);
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        border-radius: 8px;
        cursor: help; /* Показываем, что есть подсказка */
    }
</style>

<div class="container-fluid">
    <div class="logos-container">
        <div class="logos-track" id="logosTrack"></div>
    </div>
</div>

<script>
    // Данные компаний с путями к изображениям
    const companies = [
        { name: "Bootstrap", img: "{{ asset('img/bootstrap.svg') }}", height: "80px" },
        { name: "Rabbit", img: "{{ asset('img/rabbit.svg') }}", height: "80px" },
        { name: "Git", img: "{{ asset('img/git2.svg') }}", height: "40px" },
        { name: "Composer", img: "{{ asset('img/composer.png') }}", height: "80px" },
        { name: "Redis", img: "{{ asset('img/redis.svg.png') }}", height: "80px" },
        { name: "Yii", img: "{{ asset('img/yiix.png') }}", height: "80px" },
        { name: "ElasticSearch", img: "{{ asset('img/elasticsearch.png') }}", height: "50px" },
        { name: "MySql.js", img: "{{ asset('img/mysql.svg') }}", height: "62px" },
        { name: "PgSql.js", img: "{{ asset('img/pgsql.svg') }}", height: "66px" },
        { name: "HTML", img: "{{ asset('img/html3.svg') }}", height: "62px" },
        { name: "CSS3", img: "{{ asset('img/css.png') }}", height: "80px" },
        { name: "Docker", img: "{{ asset('img/docker2.png') }}", height: "80px" },
        { name: "Pinia", img: "{{ asset('img/pinia.png') }}", height: "60px" },
        { name: "Symfony", img: "{{ asset('img/symfony2.png') }}", height: "80px" },
        { name: "JavaScript", img: "{{ asset('img/js.png') }}", height: "80px" },
        { name: "Laravel", img: "{{ asset('img/laravel.png') }}", height: "80px" },
        { name: "PHP", img: "{{ asset('img/php.png') }}", height: "52px" },
        { name: "Phpstorm", img: "{{ asset('img/phpstorm.png') }}", height: "70px" },
        { name: "typeScript", img: "{{ asset('img/ts.png') }}", height: "70px" },
        { name: "Vue.js", img: "{{ asset('img/vue2.png') }}", height: "60px" },
    ];

    // Создаем логотипы
    const logosTrack = document.getElementById('logosTrack');

    // Добавляем оригинальные логотипы (3 раза подряд для плавной анимации)
    for (let i = 0; i < 30; i++) {
        companies.forEach(company => {
            const logoItem = document.createElement('div');
            logoItem.className = 'logo-item';

            const logoImg = document.createElement('img');
            logoImg.className = 'logo-image';
            logoImg.src = company.img;
            logoImg.alt = company.name;
            logoImg.title = company.name; // Название компании в title
            logoImg.style.height = company.height;

            // Добавляем обработчик ошибок загрузки изображения
            logoImg.onerror = function() {
                // Если изображение не загрузилось, показываем запасной вариант
                this.style.display = 'none';
                const fallback = document.createElement('div');
                fallback.className = 'logo-fallback';
                fallback.textContent = company.name.substring(0, 2);
                fallback.title = company.name;
                logoItem.appendChild(fallback);
            };

            logoItem.appendChild(logoImg);
            logosTrack.appendChild(logoItem);
        });
    }

    // Обновляем анимацию после загрузки DOM
    setTimeout(() => {
        // Рассчитываем ширину одного набора логотипов
        const logoItemWidth = 160; // Ширина .logo-item из CSS
        const logoItemMargin = 40; // margin: 0 20px = 40px
        const singleSetWidth = companies.length * (logoItemWidth + logoItemMargin);

        // Устанавливаем скорость анимации (40 секунд на полный цикл)
        const animationDuration = 40; // секунд

        // Обновляем анимацию
        logosTrack.style.animationDuration = `${animationDuration}s`;
    }, 100);
</script>
