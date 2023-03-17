FROM php:8-fpm

WORKDIR /tmp
RUN php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" \
&& php composer-setup.php  \
&& php -r "unlink('composer-setup.php');" \
&& mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install curl

WORKDIR /opt/application
copy . /opt/application
RUN composer install

RUN chmod a+x /opt/application/vendor/autoload.php
RUN chmod a+x run.sh
