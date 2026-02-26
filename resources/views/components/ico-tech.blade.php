<style>
    .logos-container {
        width: 100%;
        overflow: hidden;
        background-color: #1a1a1a;
        padding: 20px 0;
        border-radius: 12px;
    }

    .logos-track {
        display: flex;
        width: max-content;
        animation: scroll 120s linear infinite;
    }

    .logo-item {
        width: 160px;
        height: 100px;
        margin-right: 10px; /* расстояние между логотипами */
        background-color: #2a2a2a;
        border: 1px solid #393939;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        padding: 20px 15px;
        box-sizing: border-box;
    }

    .logo-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.4s ease;
    }

    .logo-item:hover .logo-image {
        filter: grayscale(0%);
    }

    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } /* половина ширины трека для повторения */
    }
</style>

<div class="logos-container">
    <div class="logos-track" id="logosTrack"></div>
</div>

@push('scripts')
<script>
    const companies = [
        { name: "Bootstrap", img: "{{ asset('img/bootstrap.svg') }}" },
        { name: "Rabbit", img: "{{ asset('img/rabbit.svg') }}" },
        { name: "Git", img: "{{ asset('img/git2.svg') }}" },
        { name: "Composer", img: "{{ asset('img/composer.png') }}" },
        { name: "Redis", img: "{{ asset('img/redis.svg.png') }}" },
        { name: "Yii", img: "{{ asset('img/yiix.png') }}" },
        { name: "ElasticSearch", img: "{{ asset('img/elasticsearch.png') }}" },
        { name: "MySql", img: "{{ asset('img/mysql.svg') }}" },
        { name: "PgSql", img: "{{ asset('img/pgsql.svg') }}" },
        { name: "HTML", img: "{{ asset('img/html3.svg') }}" },
        { name: "CSS3", img: "{{ asset('img/css.png') }}" },
        { name: "Docker", img: "{{ asset('img/docker2.png') }}" },
        { name: "JavaScript", img: "{{ asset('img/js.png') }}" },
        { name: "Laravel", img: "{{ asset('img/laravel.png') }}" },
        { name: "PHP", img: "{{ asset('img/php.png') }}" },
        { name: "Vue.js", img: "{{ asset('img/vue2.png') }}" },
    ];

    const track = document.getElementById('logosTrack');

    // Дублируем логотипы для плавной бесконечной анимации
    const fullList = [...companies, ...companies];

    fullList.forEach(company => {
        const div = document.createElement('div');
        div.className = 'logo-item';

        const img = document.createElement('img');
        img.className = 'logo-image';
        img.src = company.img;
        img.alt = company.name;
        img.title = company.name;

        img.onerror = function() {
            this.style.display = 'none';
            const fallback = document.createElement('div');
            fallback.className = 'logo-fallback';
            fallback.textContent = company.name.substring(0, 2);
            div.appendChild(fallback);
        }

        div.appendChild(img);
        track.appendChild(div);
    });
</script>
@endpush
