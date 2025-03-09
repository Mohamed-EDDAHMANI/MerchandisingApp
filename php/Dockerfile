FROM php:8.4-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    zip \
    nano \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Définir les permissions correctes
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html


