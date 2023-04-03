FROM php:8-fpm

RUN cp /etc/apt/sources.list /etc/apt/sources.list.bak \
    && sed -i 's/deb.debian.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apt/sources.list

RUN apt-get clean && apt-get update && apt-get install -y bash && apt-get install -y vim && apt-get install -y nginx

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /opt/application
copy . .
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN cp /opt/application/conf/nginx.conf /etc/nginx/conf.d/default.conf \
    # 关闭清理环境变量设置
    && sed -i 's/;clear_env = no/clear_env = no/g' /usr/local/etc/php-fpm.d/www.conf \
    # vefaas会占用9000端口，在9090端口启动php-fpm
    && sed -i 's/listen = 9000/listen = 9090/g' /usr/local/etc/php-fpm.d/zz-docker.conf \
    && mkdir -p /run/nginx && mkdir -p /usr/local/log

RUN chmod -R 777 /opt/application/vendor/autoload.php run.sh /usr/local/log /opt/application/storage/ /opt/application/bootstrap


EXPOSE 8000

#CMD /opt/application/run.sh

