FROM php:8-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /app
WORKDIR /app