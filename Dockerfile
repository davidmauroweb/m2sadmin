FROM php:8.1-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip

# Limpio cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensiones de php
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Traigo composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario para correr composer y artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# Subdirectorio donde va el proyecto
WORKDIR /var/www

RUN php artisan migrate:fresh

USER $user
