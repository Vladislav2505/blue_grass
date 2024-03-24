FROM php:8.2.1-fpm

WORKDIR /var/www/laravel

RUN apt-get -y update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

COPY ./conf.d/* $PHP_INI_DIR/conf.d/

CMD ["php-fpm"]