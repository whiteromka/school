FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000
ARG WITH_XDEBUG=true

ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

# 1. системные зависимости (кешируется — меняется крайне редко)
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

# 2. PHP extensions (кешируется — меняется редко)
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    pcntl \
    intl \
    xml \
    opcache \
    zip

# 3. Xdebug (кешируется — зависит от ARG)
RUN if [ "$WITH_XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug ; \
fi

# 4. composer (кешируется — меняется при обновлении composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. пользователь (кешируется — статично)
RUN groupadd -g ${GID} appgroup \
    && useradd -u ${UID} -g appgroup -m appuser

WORKDIR /var/www/html

# 6. конфиги (кешируется — меняется редко)
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

# 7. код приложения (меняется чаще всего — в самом низу)
COPY --chown=appuser:appgroup . .

USER appuser

EXPOSE 9000
