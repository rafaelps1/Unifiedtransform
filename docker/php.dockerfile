FROM php:7.4-fpm-alpine

# Install GD
RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
    #   --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev

# Install Zip
RUN apk add --no-cache zip libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql
RUN rm -rf /tmp/*

ADD ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
ADD ./docker/php/php.ini /usr/local/etc/php/php.ini

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www/html
RUN chown laravel:laravel /var/www/html

# Copy app sources
COPY --chown=laravel:laravel . /var/www/html
WORKDIR /var/www/html

# Set up application
# RUN composer update
# RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs
# RUN php artisan key:generate
# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:cache
