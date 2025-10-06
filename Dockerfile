FROM php:8.2

RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git libonig-dev libzip-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app

RUN mv .env.example .env

RUN composer update --ignore-platform-req=ext-gd



EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
