# Use the official PHP image as a base image
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . .

# Install Composer dependencies
RUN composer install --no-interaction

# Expose port 8000 for Laravel's web server
EXPOSE 8000

# Start the application with "php artisan serve"
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
