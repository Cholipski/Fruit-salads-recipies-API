#!/bin/sh

cd /var/www

php artisan key:generate
php artisan cache:clear
php artisan route:clear
php artisan migrate:fresh --seed

php-fpm -F -R
