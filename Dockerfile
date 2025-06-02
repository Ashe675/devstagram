# Fase 1: Construir los assets con Node.js
FROM node:20 as build-assets

WORKDIR /var/www/html

COPY package.json package-lock.json vite.config.js ./
RUN npm install

COPY . .

# Ejecutamos el build de Vite
RUN npm run build


# Fase 2: Entorno PHP con Apache
FROM php:8.2-apache

LABEL maintainer="tu@correo.com"

# Instalamos dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Activamos mod_rewrite y encabezados
RUN a2enmod rewrite headers expires mime

# Instalamos extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuración del directorio de trabajo
WORKDIR /var/www/html

# Copiamos archivos del proyecto
COPY . .

# Copiamos solo los archivos compilados desde la fase de build
COPY --from=build-assets /var/www/html/public/build public/build
COPY --from=build-assets /var/www/html/public/build/manifest.json manifest.json

# Instalamos dependencias de PHP
RUN composer install --optimize-autoloader --no-dev

# Generamos APP_KEY si no existe
RUN cp .env.example .env || true && php artisan key:generate --force

# Caché de configuración
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan event:cache

# Exponemos puerto 80
EXPOSE 80

# Comando final para arrancar Apache
CMD ["apache2-foreground"]