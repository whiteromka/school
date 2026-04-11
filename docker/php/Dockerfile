FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000
ARG WITH_XDEBUG=true

ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

# 1. системные зависимости
RUN apt-get update && apt-get install -y --no-install-recommends \
    bash \
    git \
    unzip \
    curl \
    zip \
    default-mysql-client \
    nodejs \
    npm \
    python3 \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    pcntl \
    intl \
    xml \
    opcache \
    zip

# 3. Xdebug (условная установка)
RUN if [ "$WITH_XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug ; \
fi

# 4. пользователь
RUN groupadd -g ${GID} appgroup \
    && useradd -u ${UID} -g appgroup -m appuser

# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 6. конфиги PHP
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

# 7. права
RUN chown -R appuser:appgroup /var/www/html

USER appuser

EXPOSE 9000
