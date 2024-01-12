# Utilisation de l'image PHP 8.2 avec Apache
FROM php:8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip

# Enable mod_rewrite
RUN a2enmod rewrite

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install mysqli pdo pdo_pgsql pgsql pdo_mysql

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the application code
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/public/pdf

# Installation de Node.js et npm
RUN apt-get install -y nodejs npm

# Installation des dépendances Node.js pour Vite
RUN npm install

RUN npm run build

# Nettoyage
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
