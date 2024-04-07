#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-propgress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env"
    cp .env.example .env
else
    echo "env file exists"
fi

export role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    exec docker-php-entrypoint "$@"
elif [ "$role" = "queue" ]; then
    echo "Running the queue ..."
    php artisan queue:work database --sleep=3 --tries=3 --verbose --timeout=20
fi
