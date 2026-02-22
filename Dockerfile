FROM php:8.2-fpm

# 1. Install dependencies sistem dan library yang dibutuhkan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    gnupg \
    libzip-dev

# 2. Install Node.js & NPM versi 20 (LTS) dari NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 3. Install PHP extensions (Termasuk zip untuk Excel/Spreadsheet)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Install Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /var/www

# 6. Copy semua file project ke dalam container
COPY . .

# 7. Install PHP dependencies (Composer)
RUN composer install --no-dev --optimize-autoloader

# 8. Install Node dependencies dan build assets (Vite/Mix)
RUN npm install && npm run build

# 9. Set permission agar Laravel bisa menulis log dan cache
# Ini sangat penting untuk mencegah error 500
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data /var/www

# 10. Ekspos port (Railway akan menggunakan port dinamis)
EXPOSE 8000

# 11. Jalankan Laravel dengan port yang diberikan oleh Railway
# Jika variabel PORT tidak ada, default ke 8000
# Ganti baris CMD terakhir di Dockerfile kamu menjadi:
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]