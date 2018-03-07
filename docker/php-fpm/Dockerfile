FROM php:fpm

RUN apt-get update \
  && apt-get install -y zlib1g-dev libicu-dev g++ git fontconfig libzip-dev \
  && pecl install zip && docker-php-ext-enable zip \
  && docker-php-ext-configure intl && docker-php-ext-install intl \
  && docker-php-ext-configure pcntl && docker-php-ext-install pcntl \
  && docker-php-ext-install opcache \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY php-fpm.conf /etc/php-fpm.conf
COPY php.ini /usr/local/etc/php/php.ini

RUN useradd -ms /bin/bash cristian
USER cristian
WORKDIR /app
