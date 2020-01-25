FROM php:7.4.2-fpm-alpine

RUN set -ex \
  	&& apk update \
    && apk add --no-cache git curl openssh-client icu libffi-dev \
    && apk add --no-cache --virtual build-dependencies icu-dev libxml2-dev  g++ make autoconf \
    && docker-php-source extract \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && cd  / && rm -fr /src \
    && apk del build-dependencies \
    && rm -rf /tmp/* 

ADD ./php.ini /usr/local/etc/php/conf.d/90-php.ini
