#!/bin/bash

# 后台启动
composer install --no-plugins --no-scripts
php-fpm -D
if [$? -ne 0]; then
  echo "fpm init failed"
fi

# 关闭后台启动，hold住进程
nginx -g 'daemon off;'
