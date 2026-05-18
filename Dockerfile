FROM php:8.2-apache

# Instala extensões PHP necessárias para o Laravel, ZIP e PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pdo_pgsql pgsql bcmath

# Ativa o mod_rewrite do Apache (essencial para as rotas do Laravel)
RUN a2enmod rewrite

# Altera a raiz do Apache para a pasta 'public' do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Dá as permissões corretas para as pastas do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Limpa QUALQUER cache que tenha subido pelo Git
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Remove QUALQUER arquivo de cache que possa ter sido gerado na compilação
RUN rm -f bootstrap/cache/config.php \
    && rm -f bootstrap/cache/routes.php \
    && rm -f bootstrap/cache/services.php \
    && rm -f bootstrap/cache/packages.php

EXPOSE 80