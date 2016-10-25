FROM php:5.6-apache

RUN docker-php-ext-install mysqli

COPY apache2/apache.conf /etc/apache2/sites-available/000-default.conf
COPY apache2/apache2.conf /etc/apache2/apache2.conf

RUN a2enmod rewrite

WORKDIR /www
VOLUME ["/www"]

EXPOSE 81
