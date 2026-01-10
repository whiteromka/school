FROM php:8.3-fpm-alpine

ARG UID
ARG GID

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    curl \
    oniguruma-dev \
    zip \
    mysql-client \
    icu-dev \
    libxml2-dev \
    build-base \
    autoconf \
    linux-headers \
    python3 \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring pcntl intl xml opcache

# Создаем пользователя appuser с указанным UID и GID
RUN addgroup -g ${GID} appgroup \
    && adduser -D -G appgroup -u ${UID} appuser

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Xdebug установка
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

# ВАЖНО: права
RUN chown -R appuser:appgroup /var/www/html

# Xdebug проброс настроек
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

USER appuser

EXPOSE 9000
