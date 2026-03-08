<?php

namespace App\Console\Commands\DB;

use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Console\Command;

/**
 * команда: php artisan seed:modules
 */
class SeedModulesCommand extends Command
{
    protected $signature = 'seed:modules';
    protected $description = 'Заполнение таблицы modules данными';

    public function __construct(
        private readonly ModuleService $moduleService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Очистка таблицы modules...');

        $modules = [
            [
                'type' => 'Back',
                'number' => 1,
                'name' => 'Старт с нуля',
                'level' => 1,
                'module_price' => 6000,
                'lesson_price' => 500,
                'count_lessons' => 12,
                'duration' => '1 - 1.5 мес',
                'techs' => ['html', 'css', 'php', 'js', 'bootstrap', 'AI'],
                'topics' => [
                    'Разметка - теги html',
                    'Базовые css правила',
                    'CSS framework Bootstrap 5',
                    'Основы программирования: переменные, массивы, циклы, функции',
                ],
                'description' => 'Это модуль общей подготовки для старта в IT. Модуль единый для back и front направления.
                    Подойдет если у вас нет ни какого опыта и понимания о цифровых технологиях. В этом модуле мы рассмотрим
                    самые простые понятия. Разберем основы HTMl, CSS, напишем пару простых скриптов. К концу этого модуля
                    у нас получится интерактивный сайт <a href="#">резюме-портфолио</a>.
                    ',
                'description2' => '',
                'active' => 1,
                'author' => Module::AUTHOR_ROMAN,
            ],

            [
                'type' => 'Back',
                'number' => 2,
                'name' => 'Основы PHP',
                'level' => 2,
                'module_price' => 6000,
                'lesson_price' => 500,
                'count_lessons' => 12,
                'duration' => '1 - 1.5 мес',
                'techs' => ['php', 'git', 'docker', 'AI'],
                'topics' => [
                    'Переменные и типы данных - строки, числа (int/float), boolean, null, массивы',
                    'Операторы: арифметические, сравнения, логические, конкатенация строк',
                    'Условные конструкции — if/else/elseif, тернарный оператор, switch',
                    'Циклы: for, while, do-while, foreach',
                    'Массивы: индексированные, ассоциативные, многомерные',
                    'Встроенные функции в языке, пользовательские функции',
                    'Простой апи на примере ТГ',
                    'Суперглобальные массивы',
                    'Поговорим про web сервер',
                    'Основы docker-compose',
                    'Основы git',
                ],
                'description' => 'Начальный модуль по PHP. Разберемся с функциональным программированием в PHP.
                    Переменные, массивы, циклы, условные операторы, супер глобальные массивы, обработка ошибок в php.
                    Помучаем Telegram API, напишем Telegram бота. Разберём, как работает клиент-серверное взаимодействие:
                    GET и POST-запросы, заголовки, куки и сессии. Поймём, как PHP получает данные от браузера и отдаёт ответ.',
                'description2' => 'В итоге должен получится блог на php',
                'active' => 1,
                'author' => Module::AUTHOR_ROMAN,
            ],

            [
                'type' => 'Back',
                'number' => 2,
                'name' => 'PHP OOP',
                'level' => 3,
                'module_price' => 6000,
                'lesson_price' => 500,
                'count_lessons' => 12,
                'duration' => '1 - 1.5 мес',
                'techs' => ['php', 'oop', 'docker', 'AI', 'git', 'html', 'css'],
                'topics' => ['Основы ООП', 'Классы, объекты', 'Конструкторы, геттеры , сеттеры', 'Свойства и методы', 'this и self', 'Модификаторы доступа', 'Абстрактные классы и интерфейсы', 'Трейты', 'Enum-ы'],
                'description' => 'PHP Объектно-Ориентированное Программирование (ООП). Концепции классов и объектов, разберем пару паттернов программирования. Напишем мини игру c персонажами предметами и экипировкой. Посмотрим как ООП работает в современных php фреймворках',
                'description2' => '',
                'active' => 1,
                'author' => Module::AUTHOR_ROMAN,
            ],

            [
                'type' => 'Back',
                'number' => 3,
                'name' => 'Framework Yii2',
                'level' => 6,
                'module_price' => 15000,
                'lesson_price' => 500,
                'count_lessons' => 36,
                'duration' => '3 - 4 мес',
                'techs' => ['php', 'oop', 'mvc', 'Yii2', 'mySql', 'composer', 'redis', 'docker', 'JS', 'AI', 'git'],
                'topics' => [
                    'Контроллеры, модели, виды', 'Миграции', 'ActiveRecord', 'Работа с БД', 'Формы', 'Маршрутизация',
                    'Компоненты фреймворка', 'Дата провайдеры', 'Безопасность', 'Авторизация', 'Виджеты', 'REST API', 'GII'
                ],
                'description' => 'Yii2 — простой в освоении и высокопроизводительный PHP-фреймворк, разработанный для создания масштабируемых
                    веб-приложений и корпоративных порталов, который может похвастаться
                    генератором кода Gii для мгновенного создания CRUD-интерфейсов, исключительной скоростью работы благодаря лёгкому ядру,
                    интуитивному Active Record с мощным Query Builder, готовым компонентам вроде RBAC и многоуровневого кэширования
                    без необходимости устанавливать десятки пакетов, встроенной поддержке Pjax и богатому набору виджетов для админ-панелей,
                    а также доступной кривой обучения с подробной русскоязычной документацией — всё это делает его оптимальным выбором
                    для проектов, где важны простота, скорость разработки, производительность и готовность нагрузкам из коробки
                ',
                'description2' => 'Стоит честно упомянуть что Yii2 не является самым популярным фреймворком на php. Но для начинающего разработчика
                    это хороший выбор - низкий порог вхождения, наличие вакансий на Yii2 и значительно меньший уровень конкуренции за рабочие места чем у laravel и Symfony.
                    На laravel и Symfony почти всегда требуются более опытные специалисты',
                'active' => 1,
                'author' => Module::AUTHOR_ROMAN,
            ],

            [
                'type' => 'Back',
                'number' => 4,
                'name' => 'Брокеры сообщений, очереди, данные',
                'level' => 7,
                'module_price' => 6000,
                'lesson_price' => 500,
                'count_lessons' => 12,
                'duration' => '1 - 1.5 мес',
                'techs' => ['Rabbit mq', 'ApacheKafka ?', 'Yii2', 'yii2-queue', 'PgSql', 'composer', 'redis', 'docker', 'AI', 'git',],
                'topics' => [
                    'Зачем нужны брокеры сообщений и очереди',
                    'Установка и запуск RabbitMQ',
                    'Очереди, обменники и ключи маршрутизации',
                    'Отправка и получение сообщений',
                    'Типы обменников: direct, topic, fanout, headers',
                    'Подтверждения и надёжная доставка',
                    'Масштабирование через консьюмеры',
                    'Задержанные и отложенные задачи',
                    'Обработка ошибок и dead letter queues',
                    'Мониторинг очередей в веб-интерфейсе'
                ],
                'description' => 'Курс по брокерам очередей для начинающих разработчиков охватывает архитектуру сообщений и паттерны
                    (producer/consumer, гарантии доставки, dead letter queues), погружение в RabbitMQ (AMQP, exchanges,
                    bindings, acknowledgments, TTL, RPC, кластеризация) и Kafka (distributed log, партиции, репликация,
                    consumer groups, offset management, Streams), практическую интеграцию с Yii2 через yii2-queue и нативные
                    библиотеки, обеспечение надёжности масштабирование, мониторинг
                ',
                'description2' => 'Напишем несколько микросервисов, заставим обмениваться данными между собой через брокеры сообщений',
                'active' => 1,
                'author' => Module::AUTHOR_ROMAN,
            ],

        ];

        $this->moduleService->seedModules($modules);

        $this->info('Модули успешно добавлены.');

        return Command::SUCCESS;
    }
}
