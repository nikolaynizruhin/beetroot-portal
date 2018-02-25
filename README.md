# Beetroot Family Portal

[![Build Status](https://travis-ci.org/nikolaynizruhin/beetroot-portal.svg?branch=master)](https://travis-ci.org/nikolaynizruhin/beetroot-portal)
[![StyleCI](https://styleci.io/repos/96702020/shield?branch=master)](https://styleci.io/repos/96702020)

This is the repository for the [family.beetroot.se](https://family.beetroot.se) portal.

## Getting started
### Installation

1. Clone this repository:
```
git clone https://github.com/nikolaynizruhin/beetroot-portal.git
```
2. Copy .env file and update it with your variables:
```
cp .env.example .env
```
3. Install composer dependencies:
```
composer install
```
4. Install and compile npm dependencies:
```
npm install
npm run dev
```
5. Migrate database (--seed optional):
```
php artisan migrate --seed
```
6. Generate app key:
```
php artisan key:generate
```
7. Create a symbolic link from `public/storage` to `storage/app/public`:
```
php artisan storage:link
```
8. Create default employee avatar and client logo:
```
storage/public/avatars/default.png
storage/public/logos/default.png
```

## Testing

```
phpunit
```
