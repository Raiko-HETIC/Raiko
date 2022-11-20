FROM php:8.1.2-apache

COPY ./app/src /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite
RUN apt-get update -y

EXPOSE 80