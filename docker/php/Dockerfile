######################################
##              Stage 1             ##
##        Composer dependencies     ##
######################################
FROM composer:2.6 AS composer

ENV DOCUMENT_ROOT=truckdriver_laravel
COPY ${DOCUMENT_ROOT}/composer.json composer.json
COPY ${DOCUMENT_ROOT}/composer.lock composer.lock
COPY ${DOCUMENT_ROOT}/artisan artisan

RUN composer update \
                 --ignore-platform-reqs \
                 --no-interaction \
                 --no-plugins \
                 --no-scripts \
                 --prefer-dist \
                 --quiet

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --quiet

# end Stage 1 #

######################################
##              Stage 2             ##
##           Nginx+PHP-FPM          ##
######################################
FROM php:8.3.0-fpm AS app_base

ARG WORKDIR=/var/www/html
ENV DOCUMENT_ROOT=${WORKDIR}
ENV LARAVEL_PROCS_NUMBER=1
ARG HOST_UID=1000
ENV USER=www-data

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    openssh-server \
    zip \
    unzip \
    supervisor \
    sqlite3  \
    cron
RUN apt-get install -y nginx
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions zip, mbstring, exif, bcmath, intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install  zip mbstring exif pcntl bcmath -j$(nproc) gd intl

# Install Redis and enable it
RUN pecl install redis  && docker-php-ext-enable redis > /dev/null

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_pgsql  > /dev/null

# Set working directory
WORKDIR $WORKDIR

RUN rm -Rf /var/www/* && \
mkdir -p /var/www/html

ADD docker/php/conf.d/php.ini $PHP_INI_DIR/conf.d/
COPY docker/nginx/production/nginx.conf /etc/nginx/

# nginx - nginx app permissions
RUN mkdir -p /run/nginx
RUN chown -R www-data:www-data /var/www/*

# bash alias for 'php artisan'
RUN touch ~/.bashrc \
    && echo 'source ~/.bash_profile' >> ~/.bashrc \
    && echo 'alias art="php artisan"' >> ~/.bash_profile \
    && echo 'alias watch="npm run watch &"' >> ~/.bash_profile

ENV LOG_CHANNEL=stderr

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer /usr/bin/composer /usr/bin/composer
# show that both Composer and PHP run as expected
RUN composer --version && php -v
COPY --from=composer /app/vendor /src/vendor

COPY docker/php/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
RUN ln -s /usr/local/bin/entrypoint.sh /

ENTRYPOINT ["entrypoint.sh"]

RUN usermod -u ${HOST_UID} www-data
RUN groupmod -g ${HOST_UID} www-data

RUN chmod -R 755 $WORKDIR
RUN chown -R www-data:www-data $WORKDIR

######################################
##              Stage 3             ##
##              xDebug              ##
######################################
FROM app_base AS app_dev

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ENV NODE_VERSION=18.x

RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION} | bash -

 # Install Node
RUN apt-get install -y nodejs

COPY docker/nginx/dev/nginx.conf /etc/nginx/conf.d/

EXPOSE 9000
CMD [ "entrypoint" ]
