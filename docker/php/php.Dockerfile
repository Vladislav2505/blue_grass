FROM php:8.2.1-fpm
RUN umask 0000

WORKDIR /var/www/laravel

RUN apt-get -y update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

CMD ["php-fpm"]
