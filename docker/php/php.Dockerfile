FROM php:8.2.1-fpm
RUN umask 0000

WORKDIR /var/www/laravel

RUN apt-get -y update && apt-get upgrade -y
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl pdo pdo_mysql && docker-php-ext-enable pdo_mysql

CMD ["php-fpm"]
