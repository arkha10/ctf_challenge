FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --chown=www-data:www-data . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]