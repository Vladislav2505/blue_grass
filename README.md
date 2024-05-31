# Blue Grass

## Installation

If use Docker - do it in docker containers
```
composer install
npm install
./artisan key:generate
./artisan storage:link
cp .env.example .env
```
Then create DB and User and fill .env (see MySQL docs)

## Create DB

```
./artisan migrate --seed
```

## Recreate DB
If you need to update or recreate DB
```
./artisan migrate:fresh --seed
```

## If use Docker

```
docker compose build
docker compose up -d
docker compose down
docker compose restart
```

# If don't use Docker

## PHP config
```
post_max_size = 60M
upload_max_filesize = 60M
max_execution_time = 180
```

## Nginx
For using HTTP
```
server {
    listen 80;
    server_name SERVER NAME;

    root PROJECT PATH;
    index index.php index.html index.htm;

    client_max_body_size 60M;

    # Доступ к статическим файлам
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Обработка PHP файлов через PHP-FPM
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Блокировка доступа к скрытым файлам и папкам
    location ~ /\.ht {
        deny all;
    }

    location ~ /\.(git|svn) {
        deny all;
    }

    # Безопасность и оптимизация
    location ~* \.(jpg|jpeg|gif|png|css|js|ico|xml|svg|woff|ttf|eot|pdf)$ {
        access_log off;
        expires max;
        add_header Cache-Control "public, must-revalidate, proxy-revalidate";
        add_header Access-Control-Allow-Origin "*";
    }
}
```
For using HTTPS
```
server {
    server_name SERVER NAME;

    root PROJECT PATH;
    index index.php index.html index.htm;

    client_max_body_size 60M;

    # Доступ к статическим файлам
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Обработка PHP файлов через PHP-FPM
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Блокировка доступа к скрытым файлам и папкам
    location ~ /\.ht {
        deny all;
    }

    location ~ /\.(git|svn) {
        deny all;
    }

    # Безопасность и оптимизация
    location ~* \.(jpg|jpeg|gif|png|css|js|ico|xml|svg|woff|ttf|eot|pdf)$ {
        access_log off;
        expires max;
        add_header Cache-Control "public, must-revalidate, proxy-revalidate";
        add_header Access-Control-Allow-Origin "*";
    }

    listen 443 ssl;
    PATH TO SSL CERTIFICATES

} server {
    if ($host = WWW SERVER NAME) {
        return 301 https://$host$request_uri;
    }

    if ($host = SERVER NAME) {
        return 301 https://$host$request_uri;
    }

    listen 80;
    server_name SERVER NAME;
    return 404;
}
```

## Supervisor
```
sudo apt install supervisor
nano /etc/supervisor/conf.d/laravel_queue_worker.conf
```
paste in supervisor .conf file
```
[program:laravel_queue_worker]
process_name=%(program_name)s_%(process_num)02d
command=php /PROJECT_PATH/artisan queue:work database --sleep=3 --tries=3 --verbose --timeout=20
autostart=true
autorestart=true
user=YOUR_USER
redirect_stderr=true
stdout_logfile=/home/YOUR_USER/logs/laravel_queue_worker.log
```
