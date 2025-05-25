FROM php:7.2-apache

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
