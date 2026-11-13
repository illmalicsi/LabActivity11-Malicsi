# Barangay Bulletin – Purok Malicsi

Lab Activity 10 for 4-334 Full-Stack Web Development.

## My personalized details

- **Posts per page:** 7, because my last name, Malicsi, has 7 letters.
- **Custom category:** Events
- **Birthday post date:** 2026-06-17

## How to run

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```