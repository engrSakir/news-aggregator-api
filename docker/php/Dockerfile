# Base image
FROM php:8.3-fpm

# Metadata
LABEL maintainer="Md. Sakir Ahmed <engr.sakir@gmail.com>"

# Argument for build mode (default: dev | prod)
ARG BUILD_MODE="dev"

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Conditionally install development tools
RUN if [ "$BUILD_MODE" = "dev" ]; then \
    apt-get update && apt-get install -y --no-install-recommends \
    git \
    vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*; \
fi

# Copy custom PHP configuration
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code
COPY ./src .
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini

# Copy entrypoint script
COPY ./docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# CMD defines the default process to run
CMD ["php-fpm"]

