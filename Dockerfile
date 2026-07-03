FROM php:8.4-fpm-alpine

# Set environment variable to allow Composer to run as root securely inside the container
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install system dependencies and PostgreSQL dev libraries
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpq-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libpng-dev \
    libzip-dev

# Install PHP extensions required for Laravel & PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql bcmath xml gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Install production dependencies cleanly with platform check bypasses
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# Setup directory permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy nginx and supervisor configs into place
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD /usr/local/bin/php artisan config:clear && /usr/local/bin/php artisan route:clear && /usr/local/bin/php artisan migrate --force && /usr/local/bin/php artisan config:cache && /usr/local/bin/php artisan route:cache && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf