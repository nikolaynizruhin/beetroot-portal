# Beetroot Portal

### Built with Laravel 5.5 + Vue 2.5

## Getting started

```
git clone https://github.com/nikolaynizruhin/BeetrootApp.git .
cp .env.example .env
export $(cat .env | xargs)
composer install
npm install
npm run dev
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan storage:link
php artisan passport:install
php -S localhost:5000 -t public
```
