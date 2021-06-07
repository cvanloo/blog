FROM php:7.4-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN mkdir /uploads && chown www-data:www-data /uploads
