FROM php:7.3.5-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENTRYPOINT ["composer"]
