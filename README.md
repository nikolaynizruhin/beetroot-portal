# Beetroot Family Portal

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
5. Migrate database:
```
php artisan migrate
```
6. Seed database with fake data (optional):
```
php artisan db:seed
```
7. Generate app key:
```
php artisan key:generate
```
8. Create a symbolic link from `public/storage` to `storage/app/public`:
```
php artisan storage:link
```
9. Install passport:
```
php artisan passport:install
```
10. Create default employee avatar and client logo:
```
storage/public/avatars/default.png
storage/public/logos/default.png
```

## Testing

```
phpunit
```
