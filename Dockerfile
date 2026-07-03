FROM php:8.3-fpm-alpine

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

# Install production dependencies (Adding --no-scripts prevents errors from hooks)
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# Setup directory permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD php artisan config:cache && php artisan route:cache && php artisan migrate --force && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf