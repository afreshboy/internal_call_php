FROM php:8

RUN cp /etc/apt/sources.list /etc/apt/sources.list.bak
RUN sed -i 's/deb.debian.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apt/sources.list \
    && sed -i 's/;opcache.enable=1/opcache.enable=1/g' /usr/local/etc/php/php.ini-production \
    && sed -i 's/;opcache.memory_consumption=128/opcache.memory_consumption=128/g' /usr/local/etc/php/php.ini-production \
    && sed -i 's/;opcache.validate_timestamps=1/opcache.validate_timestamps=60/g' /usr/local/etc/php/php.ini-production

RUN sed -i '/^;php_flag/s/;php_flag/php_flag/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i '/^php_flag/s/off/on/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i '/^;php_admin_value/s/;php/php/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's#/var/log/fpm-php.www.log#/var/log/php/www.error.log#g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/;php_admin_flag/php_admin_flag/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's#;access.log = log/$pool.access.log#access.log = /var/log/php/www.access.log#g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's#;slowlog = log/$pool.log.slow#slowlog = /var/log/php/www.log.slow#g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/;request_slowlog_timeout = 0/request_slowlog_timeout = 10/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/pm.max_children = 5/pm.max_children = 30/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/pm.start_servers = 2/pm.start_servers = 15/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/pm.max_spare_servers = 3/pm.max_spare_servers = 30/g' /usr/local/etc/php-fpm.d/www.conf

RUN mkdir /var/log/php && chown www-data:www-data /var/log/php/

RUN apt-get clean && apt-get update && apt-get install -y libcurl4-openssl-dev && apt-get install -y bash && apt-get install -y bash && apt-get install -y vim

RUN docker-php-ext-install curl

WORKDIR /opt/application
copy . /opt/application

RUN chmod a+x /opt/application/vendor/autoload.php run.sh

