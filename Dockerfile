FROM php:8-fpm

RUN cp /etc/apt/sources.list /etc/apt/sources.list.bak
RUN sed -i 's/deb.debian.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apt/sources.list

RUN apt-get clean && apt-get update && apt-get install -y libcurl4-openssl-dev

RUN docker-php-ext-install curl

WORKDIR /opt/application
copy . /opt/application


RUN apt-get install bash
RUN chmod a+x /opt/application/vendor/autoload.php
RUN chmod a+x run.sh
