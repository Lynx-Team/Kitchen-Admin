#!/bin/bash

echo "Installing php modules..."
composer install
echo "Done"

echo "Creating .env..."
cp ./.env.example ./.env
echo "Done..."

echo "Preparing project..."
php artisan key:generate
php artisan migrate
php artisan db:seed
echo "Done..."