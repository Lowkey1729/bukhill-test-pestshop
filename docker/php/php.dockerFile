FROM php:8.3-fpm as api

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN mkdir -p /var/www

WORKDIR /var/www

#Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev \
    libxml2-dev libzip-dev libc6 \
    zip unzip supervisor \
    default-mysql-client

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN adduser -G www-data --system -D -H -s /bin/bash -u ${UID} app

#Install needed php extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN pecl install --onlyreqdeps --force redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

COPY ./composer* /var/www
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY . /var/www

RUN composer install --no-scripts


RUN php artisan key:generate \
    && php artisan storage:link \
    && chmod -R 775 ./storage ./bootstrap/cache








