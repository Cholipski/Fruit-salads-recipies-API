#!/bin/sh
composer install
cd /var/www/html

php artisan key:generate
php artisan cache:clear
php artisan route:clear
php artisan migrate:fresh --seed

php-fpm -F -R
