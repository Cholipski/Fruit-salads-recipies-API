FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update  \
    && apt-get install --quiet --yes --no-install-recommends \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && pecl install -o -f redis \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /var/www
COPY --chown=www:www-data . /var/www
USER www
RUN /bin/sh -c composer install --optimize-autoloader --no-dev
RUN chmod +x /var/www/.docker/entrypoint.sh

ENTRYPOINT ["/var/www/.docker/entrypoint.sh"]
