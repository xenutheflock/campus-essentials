# Campus Essentials School Supplies — Inventory System

A Laravel inventory tracker for a school supplies store, built for
[Course code] at [School].

## What it does
- Lists every school supply on file with price, stock and supplier
- Flags any item whose stock has fallen to its reorder level
- Adds new items through a validated form

## Built with
- Laravel 13 (PHP 8.3)
- Blade templates
- SQLite

## Running it locally
```
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

## Author
Group 2 — BSIT-4A