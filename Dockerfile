FROM php:8.1-fpm

ARG WWWUSER
ARG WWWGROUP

# Add user for laravel application
RUN groupadd --force -g $WWWGROUP www
RUN useradd -u $WWWUSER -ms /bin/bash -g www www

COPY --chown=www:www-data "./../../" /var/www

# Set working directory
WORKDIR /var/www

# add root to www group
RUN chmod -R ug+w /var/www/storage

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev \
    nginx \
    && pecl install mongodb apcu && docker-php-ext-enable mongodb apcu opcache

# Install supervisor
RUN apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy nginx/php/supervisor configs
RUN cp ./docker/supervisord.conf /etc/supervisord.conf
RUN cp ./docker/php.ini /usr/local/etc/php/conf.d/app.ini
RUN cp ./docker/nginx.conf /etc/nginx/sites-enabled/default

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log
