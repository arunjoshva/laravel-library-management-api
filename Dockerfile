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
    git

# Install PHP extensions required for Laravel & PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql bcmath xml

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Install production dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Setup directory permissions for Laravel storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy Nginx and Supervisor configurations
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD php artisan migrate --force && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf