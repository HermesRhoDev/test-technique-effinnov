FROM php:8.2-apache

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Active le module rewrite d'Apache
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configuration du DocumentRoot Apache pour Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html
