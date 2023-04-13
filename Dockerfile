FROM php:8.1-alpine

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install dependencies
ADD composer.json /tmp/composer.json
ADD composer.lock /tmp/composer.lock

RUN cd /tmp && composer install --no-dev --no-scripts --no-autoloader
RUN cp -a -R /tmp /app

WORKDIR /app

# Install laravel
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy source code
ADD . /app

EXPOSE 3000

CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=3000" ]
