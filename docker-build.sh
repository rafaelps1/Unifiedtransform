#!/bin/bash

# ./docker-build.sh  -t '1.1.0.4' -p 'phpfpm' -n 'schools-masts'
while getopts ":p:n:t:" opt; do
  case $opt in
    p)
      IMAGE_PHP=$OPTARG
      ;;
    n)
      IMAGE_NGINX=$OPTARG
      ;;
    t)
      TAG=$OPTARG
      ;;
    ?)
      echo "Invalid option: -$OPTARG" >&2
      exit 1
      ;;
    :)
      echo "Option -$OPTARG requires an argument." >&2
      exit 1
      ;;
    *)
      echo "Syntax error: Unknown long option '$opt'" >&2
      exit 2
      ;;
  esac  
done

NAMESPACE='rafaelp777'
sleep 1

echo 'Start build...' 
docker build -f docker/php.dockerfile .

CONTAINER_ID=$(docker run -d -v `pwd`:/var/www/html --name $IMAGE_PHP $NAMESPACE/$IMAGE_PHP:latest)
sleep 1

echo 'Install Laravel dependences'
docker exec -it $CONTAINER_ID composer install --optimize-autoloader --no-dev --ignore-platform-reqs \
docker exec -it $CONTAINER_ID php artisan key:generate --force
sleep 1

PHP=$NAMESPACE/$IMAGE_PHP
PHP_TAG=$PHP:$TAG
echo 'Pushing image...' $IMAGE_PHP
docker tag $PHP:latest $PHP_TAG
docker push $PHP_TAG

NGINX=$NAMESPACE/$IMAGE_NGINX:$TAG
echo 'Pushing image...' $NGINX
docker build -t $NGINX -f docker/nginx.dockerfile .
docker push $NGINX

sleep 1
echo 'Done!'
