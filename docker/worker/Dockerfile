FROM php:8.4-fpm-alpine3.20

RUN apk add --no-cache \
    linux-headers \
    git \
    unzip \
    zip \
    libzip-dev \
    mysql-dev \
    autoconf \
    make \
    && docker-php-ext-install pdo pdo_mysql zip bcmath pcntl sockets \
    && apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl clear-cahe \
    && apk del .build-dependencies \
    && rm -rf /var/cache/apk/* /tmp/* \
    && apk --update add supervisor

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /application

COPY ./docker/worker/supervisor/conf.d /etc/supervisor/conf.d/

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
