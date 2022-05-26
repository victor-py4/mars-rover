FROM php:8.0-apache

RUN mkdir /etc/apache2/logs \
    && mkdir /etc/apache2/ssl
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y libmcrypt-dev locales locales-all cronolog \
    libjpeg62-turbo-dev libmcrypt-dev libssl-dev libjpeg-dev libpng-dev libfreetype6-dev libwebp-dev \
    zip unzip libzip-dev libicu-dev libxslt-dev git cron net-tools nano \
    mariadb-client libmagickwand-dev --no-install-recommends sendmail \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \ 
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install xsl \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install soap \
    && docker-php-ext-install gettext

RUN a2enmod ssl
RUN a2enmod rewrite
RUN a2enmod proxy
RUN a2enmod proxy_balancer
RUN a2enmod proxy_http