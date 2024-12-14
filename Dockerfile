# образ PHP с FPM
FROM php:8.3-fpm

# установка зависимостей
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# сomposer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# workdir
WORKDIR /var/www

# копирование файлов
COPY . .

# зависимости через сomposer
RUN composer install --optimize-autoloader --no-dev

# права
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# порт
EXPOSE 9000

CMD ["php-fpm"]
