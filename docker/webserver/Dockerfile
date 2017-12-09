FROM php:7-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN a2enmod rewrite
RUN service apache2 restart
