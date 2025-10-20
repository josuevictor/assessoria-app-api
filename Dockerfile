# Etapa 1: imagem oficial do PHP
FROM php:8.3-fpm

# Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Gerar cache de configuração e rotas
RUN php artisan config:cache && php artisan route:cache

# Expor a porta usada pelo Laravel
EXPOSE 8000

# Comando final seguro para produção no Render
CMD set -e && \
    echo "Rodando migrations..." && \
    php artisan migrate --force --quiet && \
    echo "Rodando seeders..." && \
    php artisan db:seed --class=DatabaseSeeder --quiet || echo "Seeders já foram executados ou falharam" && \
    echo "Iniciando servidor Laravel..." && \
    php artisan serve --host=0.0.0.0 --port=8000
