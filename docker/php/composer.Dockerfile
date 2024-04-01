FROM composer:latest
RUN umask 0000

WORKDIR /var/www/laravel

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
