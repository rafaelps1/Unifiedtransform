if ! [ -x "$(command -v docker-compose)" ]; then
    echo 'docker-compose is not installed thus cannot scaffold your app. Sorry, bud...' >&2
    sleep 1
    exit 1
fi

echo "Scaffolding your app using Docker... This will take a while..."
sleep 1
docker-compose up -d
docker-compose run --rm composer install
docker-compose run --rm composer update
docker-compose run --rm composer fund --ignore-platform-reqs
docker-compose run --rm artisan migrate:fresh --seed

export $(grep -v '#.*' .env | xargs)
echo "\nUnifiedtransform is ready on localhost:$DOCKER_WEBSERVER_HOST and localhost:$DOCKER_PHPMYADMIN_HOST for the PHPMyAdmin\n"
sleep 1
