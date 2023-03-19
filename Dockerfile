FROM php:8-fpm

RUN apt-get update && apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install curl

WORKDIR /opt/application
copy . /opt/application
ENV SERVICE_ID = xxxxxx

RUN apt-get install bash
RUN chmod a+x /opt/application/vendor/autoload.php
RUN chmod a+x run.sh
