#!/bin/bash
# Read Password
printf DOMAIN_NAME: 
read DOMAIN_NAME
printf DOMAIN: 
read DOMAIN
printf INSECURE_PORT: 
read INSECURE_PORT
printf SECURE_PORT: 
read SECURE_PORT
printf MYSQL_PORT: 
read MYSQL_PORT
printf PROJECT_FOLDER: 
read PROJECT_FOLDER
ENV_FOLDER=dev

cat << EOF > ./docker/$ENV_FOLDER/.env
DOMAIN_NAME=$DOMAIN_NAME
DOMAIN=$DOMAIN
ENV_FOLDER=$ENV_FOLDER
INSECURE_PORT=$INSECURE_PORT
SECURE_PORT=$SECURE_PORT
MYSQL_PORT=$MYSQL_PORT
PROJECT_FOLDER=$PROJECT_FOLDER\

EOF

cd ./docker/$ENV_FOLDER/web/apache/dev/ && mkcert dev-$DOMAIN && cd ../../../../../

cd ./docker/$ENV_FOLDER
docker-compose up -d --build
