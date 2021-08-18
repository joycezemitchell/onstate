FROM php:7.3-fpm-alpine

RUN apk update && \
    apk add libxml2-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libmcrypt-dev \
        icu-dev \
        libzip-dev \
        libxslt-dev \
        bash \
        msmtp \
        git \
        vim \
        nano \
        patch && \
    docker-php-source extract && \
    pecl bundle -d /usr/src/php/ext mcrypt && \
    rm /usr/src/php/ext/mcrypt-*.tgz && \
    docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install \
        bcmath \
        gd \
        intl \
        mcrypt \
        pdo_mysql \
		mysqli \
        soap \
        xsl \ 
        zip \
        opcache && \
    docker-php-source delete

COPY ./scripts /scripts
RUN chmod 755 /scripts/*
