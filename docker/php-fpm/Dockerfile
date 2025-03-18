FROM php:8.4-fpm-alpine3.20

# Установка необходимых зависимостей
RUN apk add --no-cache\
    linux-headers  \
    git \
    unzip \
    zip \
    libzip-dev \
    autoconf \
    make \
    && docker-php-ext-install pdo pdo_mysql zip bcmath pcntl sockets \
    && apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl clear-cache \
    && rm -rf /var/cache/apk/* \
    && apk --update add supervisor

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host=docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker/php-fpm/php.ini /usr/local/etc/php/php.ini

WORKDIR /application
