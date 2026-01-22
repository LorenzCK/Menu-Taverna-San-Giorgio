FROM php:8.4-apache

ENV TZ="Europe/Rome"

RUN apt-get update && \
    apt-get install -y \
    libicu-dev \
    locales

COPY locale.gen /etc/locale.gen
RUN locale-gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=it_IT

RUN docker-php-ext-install intl

RUN a2enmod rewrite
