FROM php:8.1-alpine

# Install required library

# Install intl extension
RUN apk add --no-cache \
    icu-dev \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-enable intl \
    && rm -rf /tmp/*

# Install mbstring extension
RUN apk add --no-cache \
    oniguruma-dev \
    && docker-php-ext-install mbstring \
    && docker-php-ext-enable mbstring \
    && rm -rf /tmp/*

# Setup bzip2 extension
RUN apk add --no-cache \
    bzip2-dev \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) bz2 \
    && docker-php-ext-enable bz2 \
    && rm -rf /tmp/*

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql pcntl exif zip

# Install pgsql
RUN apk add --no-cache libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql


# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer && rm -rf /tmp/*


# Install dependencies
ADD . /tmp
RUN cd /tmp && composer install --no-dev
RUN cp -a -R /tmp /app

WORKDIR /app

# Copy source code


EXPOSE 3000

CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=3000" ]
# ENTRYPOINT ["tail", "-f", "/dev/null"]
