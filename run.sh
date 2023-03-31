#!/bin/bash

# 后台启动
composer install --no-plugins --no-scripts
php artisan cache:clear

# 关闭后台启动，hold住进程
nginx -g 'daemon off;'
