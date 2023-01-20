## About

Test Project for BlueCoding

Made with Laravel 8 Framework

## Requirements
1. PHP Version 8 or newer
2. composer
3. Web Server running nginx, apache or other HTTP server

### Setup

```bash
# Clone the repo
git clone

cd bluecoding-test-rodolfo

# Copy .env.example to .env
cp .env.example .env

# Update/Install depencencies
composer update

# Sets the APP_KEY value in . env file
php artisan key:generate

# First setup database connections in .env such as DB_DATABASE=laravel-web-scraping  DB_USERNAME= and DB_PASSWORD
# Run all migrations and seed database
php artisan migrate:fresh --seed

```
