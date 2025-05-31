FROM php:8.3-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    supervisor \
    libzip-dev \
    nginx \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Crear directorios necesarios
RUN mkdir -p /var/www/html /var/run/php /var/log/supervisor

# Copiar código
COPY . /var/www/html

WORKDIR /var/www/html

# Instalar dependencias
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Crear enlace simbólico
RUN php artisan storage:link || true

# Copiar configuración de Nginx
COPY .docker/nginx/default.conf /etc/nginx/sites-available/default

# Copiar supervisord config
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord"]
