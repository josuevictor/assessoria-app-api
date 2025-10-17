# Etapa 1: usar imagem oficial do PHP
FROM php:8.3-fpm

# Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath

# Instalar o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto
COPY . .

# Instalar as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Gerar chave da aplicação (caso não exista)
RUN php artisan key:generate --force || true

# Gerar cache de configuração e rotas
RUN php artisan config:cache && php artisan route:cache

# Expor a porta 8000 (usada pelo Artisan serve)
EXPOSE 8000

# Comando padrão para iniciar a aplicação
CMD php artisan serve --host=0.0.0.0 --port=8000
