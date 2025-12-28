Для windows проект разворачивать внутри WSL например: ~/dev/<папка_с_проектом>

В папке с проектом выполнить команды:

// Сгенерировать .env для докера командой ниже
printf "UID=%s\nGID=%s\n" "$(id -u)" "$(id -g)" > .env

// Добавить в .env и в ./src/.env . Вместо ? вписать актуальные данные для подключения
DB_CONNECTION=mysql
DB_HOST=?
DB_PORT=?
DB_DATABASE=?
DB_USERNAME=?
DB_PASSWORD=?

// Собираем окружение
docker compose build --no-cache

// Запускаем окружение
docker compose up -d
// подождать 20 сек

// Провалиться в контейнер с Ларкой и накатить миграции, и выйти
docker compose exec app bash
php artisan migrate // если будет ошибка подождать 20 сек и повторить

// В контейнере с приложением устанавливаем бутстрап
npm install

// Запуск режима разработки фронта: Vite с hot reload
npm run dev
// Должна окрываться страница http://localhost:5173/

// Открыть в браузере проект: http://localhost:8080/

// Если нужно провалиться в контейнер с приложением: docker compose exec -it app bash