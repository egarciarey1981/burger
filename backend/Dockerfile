FROM php:8-alpine

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP PDO extension
RUN docker-php-ext-install pdo pdo_mysql