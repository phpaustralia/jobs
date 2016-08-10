#!/usr/bin/env bash

export PROJECT_NAME=jobs.phpaustralia.org

cd /var/www/${PROJECT_NAME}

chmod +x deployment/bin/*
mkdir -p storage/logs
chmod -R ugo+w storage
chown -R www-data: storage
setfacl -R -m u:"www-data":rwX storage
setfacl -dR -m u:"www-data":rwX storage

# configure services
./deployment/bin/config_nginx.sh
./deployment/bin/config_php.sh
# run laravel setup
./deployment/bin/config_laravel.sh
