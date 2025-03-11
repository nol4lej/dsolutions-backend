FROM php:8.1-apache

# Instala las extensiones necesarias y sqlite3
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    sqlite3 \
    && docker-php-ext-install zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de tu API al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-cache

# Asegura la existencia del directorio db y permisos
RUN mkdir -p db && chmod -R 777 db

# Crea la base de datos y ejecuta el esquema
RUN sqlite3 db/sqlite.db < db/schema.sql

# Configura Apache para usar mod_rewrite (necesario para Slim)
RUN a2enmod rewrite

# Expone el puerto 80
EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]