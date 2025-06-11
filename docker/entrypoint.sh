#!/bin/sh

echo "Definindo permissões para storage e cache..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# --- Leitura de Docker Secrets e Definição de Variáveis de Ambiente ---
echo "Lendo Docker Secrets..."

# Credenciais do Banco de Dados
if [ -f /run/secrets/db_password ]; then
    export DB_PASSWORD=$(cat /run/secrets/db_password)
    echo "DB_PASSWORD carregado do secret."
fi
if [ -f /run/secrets/db_username ]; then
    export DB_USERNAME=$(cat /run/secrets/db_username)
    echo "DB_USERNAME carregado do secret."
fi
if [ -f /run/secrets/db_database ]; then
    export DB_DATABASE=$(cat /run/secrets/db_database)
    echo "DB_DATABASE carregado do secret."
fi
if [ -f /run/secrets/db_host ]; then
    export DB_HOST=$(cat /run/secrets/db_host)
    echo "DB_HOST carregado do secret."
fi
if [ -f /run/secrets/db_port ]; then
    export DB_PORT=$(cat /run/secrets/db_port)
    echo "DB_PORT carregado do secret."
fi

# APP_KEY
if [ -f /run/secrets/app_key ]; then
    export APP_KEY=$(cat /run/secrets/app_key)
    echo "APP_KEY carregado do secret."
fi

# JWT_SECRET
if [ -f /run/secrets/jwt_secret ]; then
    export JWT_SECRET=$(cat /run/secrets/jwt_secret)
    echo "JWT_SECRET carregado do secret."
fi

# --- Geração de Chaves e Otimizações do Laravel ---
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY não definido ou é um placeholder. Gerando novo APP_KEY..."
    php artisan key:generate --force
fi

if command -v php artisan jwt:secret >/dev/null 2>&1; then # Verifica se o comando existe
    if [ -z "$JWT_SECRET" ]; then
        echo "JWT_SECRET não definido. Gerando novo JWT_SECRET..."
        php artisan jwt:secret --force
    fi
fi

echo "Rodando migrations do banco de dados..."
php artisan migrate --force

echo "Otimizando configurações do Laravel (config, route, view, event cache)..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# --- Iniciar os serviços principais ---
echo "Iniciando aplicação"
php-fpm && nginx -g 'daemon off;'
