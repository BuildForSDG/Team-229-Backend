FROM php:alpine

RUN apk add --no-cache $PHPIZE_DEPS && \
    pecl install xdebug && docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql

RUN apt-get install  -y openssl libssl-dev libcurl4-openssl-dev
RUN pecl install mongodb-1.6.0
RUN docker-php-ext-enable /usr/local/lib/php/extensions/no-debug-non-zts-20180731/mongodb.so

VOLUME /app
