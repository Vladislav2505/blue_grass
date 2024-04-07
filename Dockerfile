#===========================================================================#
# PHP

FROM php:8.2-fpm as php

RUN groupadd -g 1000 tvlad \
    && useradd -m -u 1000 -g tvlad tvlad

RUN apt-get update -y
RUN apt-get install -y sudo unzip libpq-dev libicu-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath intl

RUN echo "tvlad ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

USER tvlad

WORKDIR /var/www

COPY . .
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["php-fpm"]
ENTRYPOINT ["docker/entrypoint.sh"]

#===========================================================================#
# Node

FROM node:21-alpine as node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
RUN npm install

VOLUME /var/www

ENTRYPOINT ["npm", "run", "dev"]
