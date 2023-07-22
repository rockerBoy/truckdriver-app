FROM php:8.2-fpm as php_base

ARG WWWGROUP=1000
ARG POSTGRES_VERSION=14

ARG USER_ID=1000
ARG GROUP_ID=1000
ENV APP_USER=truckdriver

# create a non-root user with the provided user id and group id
RUN groupadd -g $GROUP_ID $APP_USER && \
    useradd -u $USER_ID -g $APP_USER -s /bin/bash -d /home/$APP_USER -m $APP_USER

FROM php:8.2.5-fpm AS APP_PROD

ARG WORKDIR=/var/www/html
ENV DOCUMENT_ROOT=${WORKDIR}
ENV LARAVEL_PROCS_NUMBER=1
ENV NODE_VERSION=18.x
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

RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION} | bash -

 # Install Node
RUN apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions zip, mbstring, exif, bcmath, intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install  zip mbstring exif pcntl bcmath -j$(nproc) gd intl

# Install Redis and enable it
RUN pecl install redis  && docker-php-ext-enable redis

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_pgsql

# Set working directory
WORKDIR $WORKDIR

RUN rm -Rf /var/www/* && \
mkdir -p /var/www/html

ADD ./php.ini $PHP_INI_DIR/conf.d/
ADD ./supervisor/supervisord.conf /etc/supervisor/supervisord.conf

COPY ./entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
RUN ln -s /usr/local/bin/entrypoint.sh /

ENTRYPOINT ["entrypoint.sh"]

RUN usermod -u ${HOST_UID} www-data
RUN groupmod -g ${HOST_UID} www-data

RUN chmod -R 755 $WORKDIR
RUN chown -R www-data:www-data $WORKDIR
EXPOSE 9000
CMD [ "entrypoint" ]

FROM node:18-alpine as frontend
WORKDIR /app

# Expose port 3000
EXPOSE 3000
# Define the command to run the application
CMD ["npm", "start"]
