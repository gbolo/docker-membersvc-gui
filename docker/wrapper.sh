#!/bin/sh
set -xo pipefail

########################################
#       SET UP NGINX + PHP-FPM         #
########################################
mkdir -p /data/nginx/logs
chown -R nginx: /data/nginx
rm -rf /etc/nginx/nginx.conf
ln -s /data/nginx/conf/nginx.conf /etc/nginx/nginx.conf

mkdir -p /data/php-fpm/logs
chown -R nginx: /data/php-fpm
rm -rf /etc/php5/php-fpm.conf
ln -s /data/php-fpm/conf/php-fpm.conf /etc/php5/php-fpm.conf

########################################
#          START SUPERVISORD           #
########################################
/usr/bin/supervisord -c /etc/supervisord.conf
