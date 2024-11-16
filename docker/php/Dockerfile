# Use the official PHP 8.3 image with FPM
FROM php:8.3-fpm

# Metadata
LABEL maintainer="Md. Sakir Ahmed <engr.sakir@gmail.com>"

# Install system dependencies, PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    autoconf \
    build-essential \
    curl \
    g++ \
    git \
    libcurl4-openssl-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libonig-dev \
    libpng-dev \
    libssl-dev \
    libtool \
    libzip-dev \
    pkg-config \
    unzip \
    vim \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        intl \
        mysqli \
        pdo \
        pdo_mysql \
        zip \
    && pecl channel-update pecl.php.net \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/pear


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code
COPY ./src .

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy custom PHP configuration
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini

# Install application dependencies as www-data
USER www-data
RUN composer install --classmap-authoritative --optimize-autoloader

# Run Laravel commands
USER root

# Expose port 9000 for the PHP-FPM server
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
