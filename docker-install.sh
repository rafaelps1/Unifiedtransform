if ! [ -x "$(command -v docker-compose)" ]; then
    echo 'docker-compose is not installed thus cannot scaffold your app. Sorry, bud...' >&2
    sleep 1
    exit 1
fi

echo "Scaffolding your app using Docker... This will take a while..."
sleep 1

docker-compose up --build -d
docker-compose run --rm composer install --optimize-autoloader --no-dev
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan config:cache
docker-compose run --rm artisan route:cache
docker-compose run --rm artisan view:cache
# docker-compose run --rm artisan migrate:fresh --seed

# php artisan key:generate
# php artisan cache:clear
# php artisan route:clear
# php artisan config:clear
# php artisan view:clear
# php artisan migrate:fresh --seed

# docker-compose run --rm artisan storage:link
# docker-compose run --rm artisan route:cache
# docker-compose run --rm artisan view:cache

# docker-compose run --rm artisan config:clear
# docker-compose run --rm artisan route:clear
# docker-compose run --rm artisan view:clear

# docker-compose run --rm composer require predis/predis
# docker-compose run --rm composer require league/flysystem:~1.1.3 league/flysystem-aws-s3-v3:~1.0.29 league/flysystem-cached-adapter:~1.0
# docker-compose run --rm artisan tinker
# docker-compose run --rm artisan cache:clear


## Deploy optimizing for production
# docker-compose run --rm composer install --optimize-autoloader --no-dev
# docker-compose run --rm artisan migrate
# docker-compose run --rm artisan config:cache
# docker-compose run --rm artisan route:cache
# docker-compose run --rm artisan view:cache

export $(grep -v '#.*' .env | xargs)
echo "Schools is ready on localhost:$DOCKER_WEBSERVER_HOST and localhost:$DOCKER_PHPMYADMIN_HOST for the PHPMyAdmin\n"
sleep 1
