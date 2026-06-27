FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    default-mysql-client \
    postgresql-client \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring

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
