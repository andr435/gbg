FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite
CMD ["apache2-foreground"]