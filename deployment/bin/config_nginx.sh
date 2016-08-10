#!/usr/bin/env bash

# setup nginx configuration
cat deployment/etc/nginx/sites-available/project.conf \
    | sed "s/#APP_ENV#/${DEPLOYMENT_GROUP_NAME}/g" \
    | sed "s/#PROJECT_NAME#/${PROJECT_NAME}/g" \
    > /etc/nginx/sites-available/${PROJECT_NAME}.conf

# link new config overriding any old one
ln -fs /etc/nginx/sites-available/${PROJECT_NAME}.conf /etc/nginx/sites-enabled/${PROJECT_NAME}
