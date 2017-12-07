FROM php:7-apache

RUN apt-get update -y && apt-get install -y curl php-mysql mysqli

RUN docker-php-ext-install php-mysql curl mysqli

RUN a2enmod rewrite
RUN service apache2 restart
