FROM php:8.1-fpm
RUN docker-php-ext-install pdo_mysql

RUN apt-get update && \
    apt-get install -y \
        libicu-dev \
        libpq-dev \
        git && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        intl \
        pdo \
        pdo_pgsql \
        pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code

COPY ./web .
RUN ls
RUN composer install --no-dev --no-interaction --no-progress
