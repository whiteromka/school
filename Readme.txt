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
docker compose exec app npm run dev
-------------
 php artisan config:clear
 pkill -f vite
 netstat -tulpn | grep 5173 // пусто
 ss -lntp | grep 5173
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

php artisan make:migration create_oauth_accounts_table // создать миграцию
docker compose exec app php artisan migrate --step=1    // накатить 1 миграцию
docker compose exec app php artisan migrate:rollback   // откатить миграции

php artisan make:controller UserController --resource



============ для локального теста Телеграм ===========
В wsl:
ssh -R 80:localhost:8080 serveo.net // полученный адрес вставить в SetTelegramWebhook
docker compose exec app bash      // открыть контейнер с приложением
php artisan telegram:set-webhook  // установить GT webhook
// php artisan optimize:clear     // не нужно
php artisan tinker                // заходим в карманный laravel-php
Http::get("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/getWebhookInfo")->json(); // запрос к TG

[
    "ok" => true,
    "result" => [
      "url" => "https://4bc6b92b0954b9e9-85-172-168-90.serveousercontent.com/tgbot/events",
      "has_custom_certificate" => false,
      "pending_update_count" => 0,
      "last_error_date" => 1769822556,
      "last_error_message" => "Wrong response from the webhook: 419 status code 419",
      "max_connections" => 40,
      "ip_address" => "5.255.123.12",
    ],
]


https://uiverse.io/
