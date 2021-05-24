FROM php:7.4-fpm-alpine

# timezone environment
ENV TZ=Asia/Tokyo \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

RUN apk update && \
  apk upgrade && \
  apk add --update --no-cache \
  libzip-dev libpng-dev icu-dev \
  gcc g++ make automake autoconf gettext libtool nasm bash openssl \
  nodejs nodejs-npm git

RUN docker-php-ext-install intl pdo_mysql bcmath exif gd

RUN pecl install --force xdebug-2.9.8 && docker-php-ext-enable xdebug

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
RUN composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org

COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/

WORKDIR /workspace/backend