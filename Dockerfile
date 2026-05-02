FROM php:8.3-cli-alpine

# Install required packages and PHP extensions
RUN apk add --no-cache \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev

# Install PHP extensions needed for Laravel
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring gd zip bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port (Render sets PORT env variable)
EXPOSE 8000

# Start command: migrate, link storage, and start PHP server
CMD php artisan migrate --force && php artisan storage:link && php -S 0.0.0.0:${PORT:-8000} -t public
