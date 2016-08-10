#!/usr/bin/env bash

# setup php7.0 configuration
cp deployment/etc/php/7.0/fpm/pool.d/www.conf /etc/php/7.0/fpm/pool.d/www.conf
cp deployment/etc/php/7.0/mods-available/opcache.ini /etc/php/7.0/mods-available/opcache.ini
