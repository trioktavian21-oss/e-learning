FROM php:8.2-fpm

# 1. Install dependencies dasar (Tambahkan libzip-dev di sini)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    gnupg \
    libzip-dev  # <--- Tambahkan ini

# 2. Install Node.js v20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 3. Install PHP extensions (Tambahkan zip di sini)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip # <--- Tambahkan zip

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# ... sisanya sama seperti sebelumnya ...