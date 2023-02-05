FROM php:8.1-fpm

ARG WWWGROUP=1000
ARG NODE_VERSION=16
ARG POSTGRES_VERSION=14
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
    && curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /usr/share/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/usr/share/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#COPY php.ini /etc/php/8.1/fpm/php-fpm.conf
USER 1000
EXPOSE 80
