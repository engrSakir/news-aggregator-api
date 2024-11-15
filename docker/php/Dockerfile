# Use the official PHP 8.2 image with FPM
FROM php:8.3-fpm

LABEL maintainer="Md. Sakir Ahmed <engr.sakir@gmail.com>"

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    g++ \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && pecl install redis \
    && docker-php-ext-enable redis

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code
COPY ./src .

RUN chown -R www-data:www-data /var/www

USER www-data

# Install application dependencies
RUN composer install

USER root

# Expose port 9000 for the PHP-FPM server
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
