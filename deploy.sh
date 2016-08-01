#!/usr/bin/env bash
git pull origin master
composer install
php artisan migrate