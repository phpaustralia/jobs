#!/usr/bin/env bash

PROJECT_NAME=slimecup
ENV_DIR=environments

# make sure we are in the home directory
cd

# remove any previous clones
if [ -d ${ENV_DIR} ]
then
    rm -rf ${ENV_DIR}
fi

# clone environment repository to local box
git clone github.com:3rd-master/environments.git ${ENV_DIR}

# find .env based on DEPLOYMENT_GROUP_NAME and PROJECT_NAME
if [ -f ${ENV_DIR}/${PROJECT_NAME}/${DEPLOYMENT_GROUP_NAME}/.env ]
then
    cp ${ENV_DIR}/${PROJECT_NAME}/${DEPLOYMENT_GROUP_NAME}/.env /etc/environments.d/${PROJECT_NAME}
else
    echo "Environment not found"
    exit 1;
fi
