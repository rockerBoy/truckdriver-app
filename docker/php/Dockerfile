FROM php:8.2-fpm as php_base

ARG WWWGROUP=1000
ARG POSTGRES_VERSION=14

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG APP_USER=appuser

# create a non-root user with the provided user id and group id
RUN groupadd -g $GROUP_ID ${APP_USER} && \
    useradd -u $USER_ID -g ${APP_USER} -s /bin/bash -d /home/${APP_USER} -m ${APP_USER}

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 libcurl4-openssl-dev openssl zlib1g-dev libicu-dev libpq-dev libxml2-dev wget \
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && echo "keyserver hkp://keyserver.ubuntu.com:80" >> ~/.gnupg/dirmngr.conf \
    && gpg --recv-key 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c \
    && gpg --export 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c > /usr/share/keyrings/ppa_ondrej_php.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \

RUN docker-php-ext-install -j$(nproc) iconv intl xml soap mcrypt opcace pdo_mysql pdo_sqlite bcmath readline ldap msgpack igbinary redis swoole memcached pcov mysqli mbstring pgsql zip sqlite3
RUN docker-php-ext-install -j$(nproc) gd

RUN apt-get install --no-install-recommends -y libpq-dev
RUN docker-php-ext-install pdo pgsql pdo_pgsql

RUN pecl install redis xdebug
RUN docker-php-ext-enable redis pgsql pdo_pgsql xdebug

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get update \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

USER ${APP_USER}
EXPOSE 80

FROM node:18-alpine as frontend
WORKDIR /app

# Expose port 3000
EXPOSE 3000
# Define the command to run the application
CMD ["npm", "start"]
