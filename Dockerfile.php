# Use the official PHP-FPM image
FROM php:8.1-fpm-alpine

# Install the intl, dom, and mysqli extensions
RUN apk --no-cache add icu-dev libxml2-dev \
    && docker-php-ext-install intl dom pdo pdo_mysql mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk add --no-cache bash vim

# Copy the CodeIgniter application into the container
COPY . /var/www

# After the COPY command
RUN chmod -R 755 /var/www/writable

RUN chown -R www-data:www-data /var/www/writable
