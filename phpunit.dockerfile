FROM php:7.4.19-cli
RUN docker-php-ext-install pdo pdo_mysql mysqli
