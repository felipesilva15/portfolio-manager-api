FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nginx \
    unzip \
    mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN rm /etc/nginx/conf.d/default.conf

COPY docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["php-fpm"]
