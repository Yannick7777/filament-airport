#!/bin/pwsh

$composer_docker_hash=$(docker build -q .)
docker run --rm -v ./filament-airport:/var/www/html -it $composer_docker_hash composer update -W
cp env_docker filament-airport/.env
cp env_docker .env
docker compose up -d
Start-Sleep -Seconds 5
docker compose exec app chown www-data:www-data /var/www -R
docker compose exec app php artisan key:generate
docker compose exec app php artisan config:cache

while ($true) {
    Start-Sleep -Seconds 3
    $success = docker compose exec app php artisan migrate:fresh
    if ($success) {break}
}
docker compose exec app php artisan db:seed
docker compose exec app php artisan test
docker compose down
