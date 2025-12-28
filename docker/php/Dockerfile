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
    python3 \
    nodejs  \
    npm \
    && docker-php-ext-install pdo_mysql mbstring pcntl intl xml opcache

# Создаем пользователя appuser с указанным UID и GID
RUN addgroup -g ${GID} appgroup \
    && adduser -D -G appgroup -u ${UID} appuser

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ВАЖНО: права
RUN chown -R appuser:appgroup /var/www/html

USER appuser

EXPOSE 9000
