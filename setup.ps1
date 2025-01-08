#!/bin/pwsh

$composer_docker_hash=$(docker build -q .)
docker run --rm -v $pwd/filament-airport:/var/www/html -it $composer_docker_hash composer install
cp env_docker filament-airport/.env
cp env_docker .env
docker compose -f compose_win.yaml up -d
Start-Sleep -Seconds 5
docker compose -f compose_win.yaml exec app chown www-data:www-data /var/www -R
docker compose -f compose_win.yaml exec app php artisan key:generate
docker compose -f compose_win.yaml exec app php artisan config:cache

while ($true) {
    Start-Sleep -Seconds 3
    $success = docker compose -f compose_win.yaml exec app php artisan migrate:fresh
    if ($success) {break}
}
docker compose -f compose_win.yaml exec app php artisan db:seed
docker compose -f compose_win.yaml exec app php artisan test
docker compose -f compose_win.yaml down
