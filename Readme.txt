Для windows проект разворачивать внутри WSL например: ~/dev/<папка_с_проектом>

Склонировать через git:
git clone git@github.com:whiteromka/shcool.git
cd shcool

// Создать в корне .env с такими настройками:
UID=1000
GID=1000
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:ZQ/re0PAL++HOgecVtZkJKZqtBWS6Fu+xKSyf9T3TFU=
APP_DEBUG=true
APP_URL=http://localhost:8080
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=? # заменить на настоящий
DB_PASSWORD=? # заменить на настоящий
MYSQL_ROOT_PASSWORD=? # заменить на настоящий
CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
#   на случай если возникнет ошибка с БД, раскоментировать эти строки
#   CACHE_STORE=file
#   SESSION_DRIVER=file
#   QUEUE_CONNECTION=sync

Выполнить команды:
id -u  # эту цифру вписать в .env в значение для UID
id -g  # эту цифру вписать в .env в значение для GID

// Собираем окружение
docker compose build --no-cache

// Запускаем окружение
docker compose up -d

// Провалиться в контейнер с Ларкой и накатить миграции, и выйти
docker compose exec app bash
composer install
php artisan migrate // если будет ошибка подождать 20 сек и повторить
                  проверка подключения:  mysql -h db -u <DB_USERNAME> -p --ssl=0

// В контейнере с приложением устанавливаем бутстрап
npm install

// Запуск режима разработки фронта: Vite с hot reload
npm run dev
// Должна открываться страница http://localhost:5173/

// Открыть в браузере проект: http://localhost:8080/

// Готово!
=============


// Все последующие запуски так:
docker compose up -d
docker compose exec app bash
npm run dev
=============

// Прочие команды:
docker compose down
docker compose build --no-cache
docker compose up -d
docker compose exec app php -v

// Лара прочие команды:
docker compose exec -it app bash // провалиться в контейнер с приложением
docker compose exec app php artisan optimize:clear  // чистка кэша
docker compose exec app php artisan key:generate // генерация ключа
docker compose exec app php artisan migrate // миграции
