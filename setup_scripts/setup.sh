#!/bin/bash

git clone https://github.com/bfso/filament-airport
composer_docker_hash=$(docker build -q .)
docker run --rm -v ./filament-airport:/var/www/html -it $composer_docker_hash composer update -W
cp env_docker filament-airport/.env
docker compose up -d
sleep 5
docker compose exec app chown www-data:www-data /var/www -R
docker compose exec app php artisan key:generate
docker compose exec app php artisan config:cache
while true; do sleep 3s && docker compose exec app php artisan migrate:fresh && break; done
docker compose exec app php artisan test
docker compose down
