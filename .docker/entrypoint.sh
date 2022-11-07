#!/bin/sh

cd /var/www

php artisan key:generate
php artisan cache:clear
php artisan route:clear

php-fpm -F -R
