# Use a imagem oficial do PHP como base
FROM php:8.1-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto para o diretório de trabalho
COPY . /var/www

# Instalar dependências do Laravel
RUN composer install

# Copiar o arquivo de configuração do PHP
COPY ./docker/php/php.ini /usr/local/etc/php/

# Ajustar permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expor a porta
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]

