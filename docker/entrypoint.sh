#!/bin/sh

echo "Definindo permissões para storage e cache..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 755 /var/www/html/public
chown -R www-data:www-data /var/www/html/public

echo "Gerando arquivo .env a partir de template..."
envsubst < .env.template > .env

echo "Gerando novo APP Key..."
php artisan key:generate --force

echo "Gerando novo JWT Secret..."
php artisan jwt:secret --force

echo "Otimizando configurações do Laravel..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Rodando migrations do banco de dados..."
php artisan migrate --force

echo "Iniciando aplicação..."
apache2-foreground
