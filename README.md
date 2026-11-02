# Multi-Store E-Commerce (Laravel)

A multi-store e-commerce application built with **Laravel 10**. Store owners manage their stores, categories and products from a dashboard, while customers browse products and shop through the storefront.

## Features

**Dashboard**
- Stores management (multi-vendor)
- Categories and products CRUD
- Profile management

**Storefront**
- Home page and product listing
- Product details with SEO-friendly slugs
- Shopping cart

**Platform**
- Authentication with Laravel Fortify
- REST API for products (Laravel Sanctum)
- Arabic / English localization (`mcamara/laravel-localization`)

## Tech Stack

PHP · Laravel 10 · Fortify · Sanctum · Blade · MySQL

## Getting Started

```bash
git clone https://github.com/mhmdatya72/ecommerce.git
cd ecommerce
composer install && npm install
cp .env.example .env
php artisan key:generate
# set your DB_* values in .env
php artisan migrate
npm run build
php artisan serve
```

## Author

**Mohamed Atya Hawash** — Senior Full-Stack Laravel Developer
[Portfolio](https://mohamedatya-dev.vercel.app) · [LinkedIn](https://www.linkedin.com/in/mohamedatya-dev/)
