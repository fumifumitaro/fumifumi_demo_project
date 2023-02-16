FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev mariadb-client \
    && apt-get install -y wget git unzip libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-install zip pdo_mysql

COPY --from=composer:1.8.6 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

ENTRYPOINT ["composer"]
