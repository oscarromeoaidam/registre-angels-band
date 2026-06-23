FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    default-mysql-client \
    postgresql-client \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs storage/app/public bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate --force && \
    (php artisan storage:link || true) && \
    php artisan serve --host=0.0.0.0 --port=$PORT