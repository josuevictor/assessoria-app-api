# Etapa 1: imagem PHP
FROM php:8.3-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Gerar cache de configuração e rotas
RUN php artisan config:cache && php artisan route:cache

EXPOSE 8000

# Comando final seguro
CMD php artisan migrate --force --quiet && \
    php artisan db:seed --class=DatabaseSeeder --quiet && \
    php artisan serve --host=0.0.0.0 --port=8000
