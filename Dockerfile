FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    nano \
    curl
    # libpng-dev \
    # libonig-dev \
    # libxml2-dev \
    # zip \
    # unzipdock

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install pdo_mysql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

ADD . /var/www/

RUN cp .env.example .env

RUN composer install

RUN php artisan key:generate
RUN php artisan storage:link

RUN composer dumpautoload

RUN chmod -R 777 storage/
RUN chmod -R 777 bootstrap/
RUN chmod -R 777 database/


#USER $user
