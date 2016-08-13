#!/usr/bin/env bash

ln -fs /etc/environments.d/${PROJECT_NAME} /var/www/${PROJECT_NAME}/.env

# this is needed here incase a package is removed artisan will fail
# on the next call due to missing package not being available.
rm -f /var/www/${PROJECT_NAME}/bootstrap/cache/config.php

# put application into maintenance mode
php artisan down

# setup
php artisan cache:clear --env=${APP_ENV}
php artisan optimize --env=${APP_ENV}
php artisan config:cache --env=${APP_ENV}
php artisan migrate --env=${APP_ENV} --force

# take application out of maintenance mode
php artisan up
