# internal_call_php
*nginx版本在feat_nginx分支*  
一、本机运行  
1、在机器上安装docker  
2、将dockerfile中最后一行 执行run.sh解除注释  
3、docker build -t internal_php:v1 .  
4、docker run -it -d --name internal_php_v1 -p 8080:8000 internal_php:v1  
5、docker exec -it internal_php_v1 /bin/bash  
二、部署vefaas  
直接部署就好
