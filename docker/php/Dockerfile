FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000
ARG WITH_XDEBUG=false

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip zip \
    libicu-dev libxml2-dev libzip-dev libonig-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Установка Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo_mysql mbstring pcntl intl xml opcache zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаём пользователя
RUN groupadd -g ${GID} appgroup \
    && useradd -u ${UID} -g appgroup -m appuser

# Копируем все файлы проекта (пока от root)
COPY . .

# СОЗДАЁМ ДИРЕКТОРИИ ЗАНОВО (решение проблемы)
#RUN mkdir -p storage/framework/{cache,sessions,views} \
#    && mkdir -p storage/logs \
#    && mkdir -p bootstrap/cache
#
## Устанавливаем правильные права (ВАЖНО: после создания директорий)
#RUN chown -R appuser:appgroup storage bootstrap/cache \
#    && chmod -R 775 storage bootstrap/cache
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
 && chown -R appuser:appgroup storage bootstrap/cache

# Запускаем composer от root (но файлы уже с правильными правами)
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN if [ "$WITH_XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug ; \
fi

USER appuser

EXPOSE 9000
