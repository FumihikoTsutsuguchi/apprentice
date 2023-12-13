FROM php:8.2.4-apache

ENV TZ Asia/Tokyo
ENV APACHE_DOCUMENT_ROOT /quest_php/app

RUN mkdir /quest_php
WORKDIR /quest_php

COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
  && echo ${TZ} > /etc/timezone

RUN apt-get update \
  && apt-get install -y \
    cron \
    vim \
  && docker-php-ext-install pdo_mysql

RUN sed -ri -e \
  's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
  /etc/apache2/sites-available/*.conf

RUN sed -ri -e \
  's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
  /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
