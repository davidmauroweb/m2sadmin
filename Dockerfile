FROM php:8.1-fpm

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip

RUN echo " Limpio cache"
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN echo " Instala extensiones de php"
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN echo "# Traigo composer"
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

RUN echo "# cambio permisos de los archivos del proy"
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

EXPOSE 9000